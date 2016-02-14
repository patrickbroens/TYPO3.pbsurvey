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
use PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined;

/**
 * Predefined option repository
 */
class OptionPredefinedRepository extends AbstractRepository
{
    /**
     * Select the predefined options by the parent option group
     *
     * @var int $predefinedOptionGroupUid The id of the parent option group
     * @param array $loadObjects The nested objects which should be loaded
     * @return array The predefined options
     */
    public function findByPredefinedOptionGroup($predefinedOptionGroupUid, $loadObjects = [])
    {
        $predefinedOptions = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                label,
                sorting
            ',
            'tx_pbsurvey_option_predefined',
            '
                parentid = '. (int)$predefinedOptionGroupUid . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $predefinedOptions;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $predefinedOptions[] = $this->setPredefinedOptionFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $predefinedOptions;
    }

    /**
     * Insert an option
     *
     * @param int $parentId The parent ID
     * @param string $value The value of the option
     */
    public function insert($parentId, $value) {
        $databaseResource = $this->getDatabaseConnection()->exec_INSERTquery(
            'tx_pbsurvey_option_predefined',
            [
                'parentid' => (int)$parentId,
                'value' => (string)$value
            ]
        );

        $this->getDatabaseConnection()->sql_free_result($databaseResource);
    }

    /**
     * Set a predefined option from a database record
     *
     * @param array $record The database record
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined The predefined option
     */
    protected function setPredefinedOptionFromRecord($record, $loadObjects)
    {
        /** @var \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined $predefinedOption */
        $predefinedOption = GeneralUtility::makeInstance(OptionPredefined::class);
        $predefinedOption->fill($record);

        return $predefinedOption;
    }
}