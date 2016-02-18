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
use PatrickBroens\Pbsurvey\Domain\Model\PageConditionGroup;
use PatrickBroens\Pbsurvey\Domain\Model\PageConditionRule;

/**
 * Page condition group repository
 */
class PageConditionGroupRepository extends AbstractRepository
{
    /**
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return PageConditionGroup[]
     */
    public function findByPage($pageUid, $loadObjects = [])
    {
        $pageConditionGroups = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                name,
                rules
            ',
            'tx_pbsurvey_page_condition_group',
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
            return $pageConditionGroups;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $pageConditionGroups[] = $this->setPageConditionGroupFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $pageConditionGroups;
    }

    /**
     * Set an page condition group from a database record
     *
     * @param array $record The database record
     * @param array $loadObjects The nested models which should be loaded
     * @return PageConditionGroup The page condition group
     */
    protected function setPageConditionGroupFromRecord($record, $loadObjects)
    {
        /** @var PageConditionGroup $pageConditionGroup */
        $pageConditionGroup = GeneralUtility::makeInstance(PageConditionGroup::class);
        $pageConditionGroup->fill($record);

        if (in_array('PageConditionRule', $loadObjects)) {
            $pageConditionGroup->addRules($this->getPageConditionRules($pageConditionGroup, $loadObjects));
        }

        return $pageConditionGroup;
    }

    /**
     * Get the condition rules
     *
     * @param PageConditionGroup $pageConditionGroup The item
     * @param array $loadObjects The nested models which should be loaded
     * @return PageConditionRule[] The item rows
     */
    protected function getPageConditionRules($pageConditionGroup, $loadObjects) {
        $pageConditionRuleRepository = GeneralUtility::makeInstance(OptionRepository::class);
        return $pageConditionRuleRepository->findByPageConditionGroup($pageConditionGroup->getUid(), $loadObjects);
    }
}