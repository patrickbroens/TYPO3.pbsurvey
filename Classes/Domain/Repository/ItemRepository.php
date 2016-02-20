<?php
namespace PatrickBroens\Pbsurvey\Domain\Repository;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use PatrickBroens\Pbsurvey\Domain\Model\Item;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use PatrickBroens\Pbsurvey\Survey\ItemProvider;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item repository
 */
class ItemRepository extends AbstractRepository
{
    /**
     * @var ItemProvider
     */
    protected $itemProvider;

    /**
     * Constructor
     *
     * Set the item provider
     */
    public function __construct()
    {

        $this->itemProvider = GeneralUtility::makeInstance(ItemProvider::class);
    }

    /**
     * @param int $parentId The uid of the parent survey page
     * @return AbstractItem[]
     */
    public function findByParentId($parentId)
    {
        $items = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '*',
            'tx_pbsurvey_item',
            '
                parentid = ' . (int)$parentId . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $items;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $items[] = $this->setItemFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $items;
    }

    /**
     * Update fields
     *
     * @param int $uid The uid of the item to be updated
     * @param array $fields The fields to be updated
     */
    public function updateFields($uid, array $fields)
    {
        $databaseResource = $this->getDatabaseConnection()->exec_UPDATEquery(
            'tx_pbsurvey_item',
            'uid = ' . (int)$uid,
            $fields
        );

        $this->getDatabaseConnection()->sql_free_result($databaseResource);
    }

    /**
     * Set an item from a database record
     *
     * @param array $record The database record
     * @return AbstractItem The item
     */
    protected function setItemFromRecord($record)
    {
        $itemClassName = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['items'][(int)$record['question_type']];

        $item = GeneralUtility::makeInstance($itemClassName);
        $item->populate($record);

        if ($item instanceof AbstractChoice) {
            $item->addOptions($this->getOptions($item));
        }

        if (is_callable([$itemClassName, 'addFileReferences'])) {
            $item->addFileReferences($this->getFileReferences($item));
        }

        if (is_callable([$itemClassName, 'addRows'])) {
            $item->addRows($this->getOptionRows($item));
        }

        $this->itemProvider->addSingle($item);

        return $item;
    }

    /**
     * Get the item options
     *
     * @param AbstractItem $item The item
     * @return Option[] The item options
     */
    protected function getOptions($item) {
        $optionRepository = GeneralUtility::makeInstance(OptionRepository::class);
        return $optionRepository->findByParentId($item->getUid());
    }

    /**
     * Get the item file references
     *
     * @param AbstractItem $item The item
     * @return FileReference[] The item file references
     */
    protected function getFileReferences($item) {
        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        return $fileRepository->findByRelation('tx_pbsurvey_item', 'file_references', $item->getUid());
    }

    /**
     * Get the item rows
     *
     * @param AbstractItem $item The item
     * @return OptionRow[] The item rows
     */
    protected function getOptionRows($item) {
        $rowRepository = GeneralUtility::makeInstance(OptionRowRepository::class);
        return $rowRepository->findByParentId($item->getUid());
    }
}