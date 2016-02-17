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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\FileRepository;
use PatrickBroens\Pbsurvey\Domain\Model\Item;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractFileReference;
use PatrickBroens\Pbsurvey\Memoization\ItemMemoizationCache;

/**
 * Item repository
 */
class ItemRepository extends AbstractRepository
{
    /**
     * The item runtime cache
     *
     * Some items are needed multiple times within runtime
     *
     * @var \PatrickBroens\Pbsurvey\Memoization\ItemMemoizationCache
     */
    protected $itemMemoizationCache;

    /**
     * Constructor
     *
     * Set the item runtime cache
     */
    public function __construct()
    {
        $this->itemMemoizationCache = GeneralUtility::makeInstance(ItemMemoizationCache::class);
    }

    /**
     * Find an item by its uid
     *
     * Checks if it is in item runtime cache,
     * otherwise will be loaded from database
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem
     */
    public function findByUid($itemUid, $loadObjects = [])
    {
        $item = null;

        if ($this->itemMemoizationCache->hasByUid($itemUid, $loadObjects)) {
            $item = $this->itemMemoizationCache->getByUid($itemUid, $loadObjects);
        } else {
            $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
                '*',
                'tx_pbsurvey_item',
                '
                    uid = ' . (int)$itemUid . '
                    AND hidden = 0
                    AND deleted = 0
                '
            );

            if ($record) {
                $item = $this->setItemFromRecord($record, $loadObjects);
                $this->itemMemoizationCache->storeByUid($item->getUid(), $item, $loadObjects);
            }
        }

        return $item;
    }

    /**
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem[]
     */
    public function findByPage($pageUid, $loadObjects = [])
    {
        $items = [];

        if ($this->itemMemoizationCache->hasByPage($pageUid, $loadObjects)) {
            $items = $this->itemMemoizationCache->getByPage($pageUid, $loadObjects);
        } else {
            $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
                '*',
                'tx_pbsurvey_item',
                '
                    parentid = ' . (int)$pageUid . '
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
                $items[] = $this->setItemFromRecord($record, $loadObjects);
            }

            $this->getDatabaseConnection()->sql_free_result($databaseResource);

            $this->itemMemoizationCache->storeByPage($pageUid, $items, $loadObjects);
        }

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
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem The item
     */
    protected function setItemFromRecord($record, $loadObjects)
    {
        $itemClassName = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['items'][(int)$record['question_type']];

        $item = GeneralUtility::makeInstance($itemClassName);
        $item->fill($record);

        if (in_array('Option', $loadObjects) && ($item instanceof AbstractChoice)) {
            $item->addOptions($this->getOptions($item, $loadObjects));
        }

        if (in_array('FileReference', $loadObjects) && is_callable([$itemClassName, 'addFileReferences'])) {
            $item->addFileReferences($this->getFileReferences($item, $loadObjects));
        }

        if (in_array('Row', $loadObjects) && method_exists($item, 'addRows')) {
            $item->addRows($this->getRows($item, $loadObjects));
        }

        return $item;
    }

    /**
     * Get the item options
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem $item The item
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[] The item options
     */
    protected function getOptions($item, $loadObjects) {
        $optionRepository = GeneralUtility::makeInstance(OptionRepository::class);
        return $optionRepository->findByItem($item->getUid(), $loadObjects);
    }

    /**
     * Get the item file references
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem $item The item
     * @param array $loadObjects The nested models which should be loaded
     * @return \TYPO3\CMS\Core\Resource\FileReference[] The item file references
     */
    protected function getFileReferences($item, $loadObjects) {
        $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
        return $fileRepository->findByRelation('tx_pbsurvey_item', 'file_references', $item->getUid());
    }

    /**
     * Get the item rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem $item The item
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Row[] The item rows
     */
    protected function getRows($item, $loadObjects) {
        $rowRepository = GeneralUtility::makeInstance(OptionRowRepository::class);
        return $rowRepository->findByItem($item->getUid(), $loadObjects);
    }
}