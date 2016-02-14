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
use PatrickBroens\Pbsurvey\Domain\Model\Row;

/**
 * Row repository
 */
class RowRepository extends AbstractRepository
{
    /**
     * @param int $itemUid The uid of the survey item
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Row[]
     */
    public function findByItem($itemUid, $loadObjects = [])
    {
        $rows = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                name
            ',
            'tx_pbsurvey_row',
            '
                parentid = ' . (int)$itemUid . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $rows;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $rows[] = $this->setRowFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $rows;
    }

    /**
     * Set an row from a database record
     *
     * @param array $record The database record
     * @param array $loadObjects The nested models which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Row The row
     */
    protected function setRowFromRecord($record, $loadObjects)
    {
        $option = GeneralUtility::makeInstance(Row::class);
        $option->fill($record);

        return $option;
    }
}