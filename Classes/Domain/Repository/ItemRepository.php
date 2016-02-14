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
use PatrickBroens\Pbsurvey\Domain\Model\Item;

/**
 * Item repository
 */
class ItemRepository extends AbstractRepository
{
    /**
     * Find an item by its uid
     *
     * Checks if it is in session item cache,
     * otherwise will be loaded from database
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item
     */
    public function findByUid($itemUid, $loadObjects = [])
    {
        $item = null;

        $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            '*',
            'tx_pbsurvey_item',
            '
                uid = ' . (int)$itemUid . '
                AND hidden = 0
                AND deleted = 0
            '
        );

        if ($record !== null) {
            $item = $this->setItemFromRecord($record, $loadObjects);
        }

        return $item;
    }

    /**
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item[]
     */
    public function findByPage($pageUid, $loadObjects = [])
    {
        $items = [];

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
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Item The item
     */
    protected function setItemFromRecord($record, $loadObjects)
    {
        $itemClassName = 'PatrickBroens\Pbsurvey\Domain\Model\Item\ItemType' . (int)$record['question_type'];

        $item = GeneralUtility::makeInstance($itemClassName);
        $item->fill($record);

        if (in_array('Option', $loadObjects) && method_exists($item, 'addAnswers')) {
            $item->addAnswers($this->getOptions($item, $loadObjects));
        }

        if (in_array('Row', $loadObjects) && method_exists($item, 'addRows')) {
            $item->addRows($this->getRows($item, $loadObjects));
        }

        return $item;
    }

    /**
     * Get the item rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item $item The item
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[] The item rows
     */
    protected function getOptions($item, $loadObjects) {
        $optionRepository = GeneralUtility::makeInstance(OptionRepository::class);
        return $optionRepository->findByItem($item->getUid(), $loadObjects);
    }

    /**
     * Get the item rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item $item The item
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Row[] The item rows
     */
    protected function getRows($item, $loadObjects) {
        $rowRepository = GeneralUtility::makeInstance(RowRepository::class);
        return $rowRepository->findByItem($item->getUid(), $loadObjects);
    }
}