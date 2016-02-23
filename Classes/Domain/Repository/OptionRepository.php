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

use PatrickBroens\Pbsurvey\Domain\Model\Option;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Option repository
 */
class OptionRepository extends AbstractRepository
{
    /**
     * Find an option by its parent id
     *
     * @param int $itemUid The uid of the survey item
     * @return Option[]
     */
    public function findByParentId($itemUid)
    {
        $options = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                checked,
                points,
                value
            ',
            'tx_pbsurvey_option',
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
            return $options;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $options[] = $this->setOptionFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $options;
    }

    /**
     * Delete the options by parent ID
     *
     * @var int $parentId The parent id of the options to be deleted
     */
    public function deleteByParentId($parentId)
    {
        $databaseResource = $this->getDatabaseConnection()->sql_query('
            DELETE FROM tx_pbsurvey_option
            WHERE parentid = ' . $parentId . '
        ');

        $this->getDatabaseConnection()->sql_free_result($databaseResource);
    }

    /**
     * Insert an option
     *
     * @param int $parentId The parent ID
     * @param string $value The value of the option
     * @param int $sorting The sorting order
     */
    public function insert($parentId, $value, $sorting) {
        $databaseResource = $this->getDatabaseConnection()->exec_INSERTquery(
            'tx_pbsurvey_option',
            [
                'parentid' => (int)$parentId,
                'value' => (string)$value,
                'sorting' => (int)$sorting
            ]
        );

        $this->getDatabaseConnection()->sql_free_result($databaseResource);
    }

    /**
     * Set an option from a database record
     *
     * @param array $record The database record
     * @return Option The option
     */
    protected function setOptionFromRecord($record)
    {
        /** @var Option $option */
        $option = GeneralUtility::makeInstance(Option::class);
        $option->populate($record);

        return $option;
    }
}