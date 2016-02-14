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
use PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup;
use PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedRepository;

/**
 * Predefined option group repository
 */
class OptionPredefinedGroupRepository extends AbstractRepository
{
    /**
     * Get the predefined option groups
     *
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup[] The predefined option groups
     */
    public function findAll($loadObjects = [])
    {
        $predefinedOptionGroups = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                name
            ',
            'tx_pbsurvey_option_predefined_group',
            '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'name ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $predefinedOptionGroups;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $predefinedOptionGroups[] = $this->setPredefinedOptionGroupFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $predefinedOptionGroups;
    }

    /**
     * Set a predefined option group from a database record
     *
     * @param array $record The database record
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup The predefined option group
     */
    protected function setPredefinedOptionGroupFromRecord($record, $loadObjects)
    {
        /** @var \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup $predefinedOptionGroup */
        $predefinedOptionGroup = GeneralUtility::makeInstance(OptionPredefinedGroup::class);
        $predefinedOptionGroup->fill($record);

        if (in_array('OptionPredefined', $loadObjects)) {
            $predefinedOptionGroup->addOptions($this->getOptions($predefinedOptionGroup, $loadObjects));
        }

        return $predefinedOptionGroup;
    }

    /**
     * Get the group options
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup $predefinedOptionGroup The predefined option group
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined[] The group options
     */
    protected function getOptions(OptionPredefinedGroup $predefinedOptionGroup, array $loadObjects) {
        $optionPredefinedRepository = GeneralUtility::makeInstance(OptionPredefinedRepository::class);
        return $optionPredefinedRepository->findByPredefinedOptionGroup($predefinedOptionGroup, $loadObjects);
    }
}