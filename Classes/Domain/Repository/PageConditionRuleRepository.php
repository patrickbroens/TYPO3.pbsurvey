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

use PatrickBroens\Pbsurvey\Survey\PageConditionRuleProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\PageConditionGroup;
use PatrickBroens\Pbsurvey\Domain\Model\PageConditionRule;

/**
 * Page condition rule repository
 */
class PageConditionRuleRepository extends AbstractRepository
{
    /**
     * The page condition rule provider
     *
     * @var PageConditionRuleProvider
     */
    protected $pageConditionRuleProvider;

    /**
     * Constructor
     *
     * Set the page condition rule provider
     */
    public function __construct()
    {
        $this->pageConditionRuleProvider = GeneralUtility::makeInstance(PageConditionRuleProvider::class);
    }

    /**
     * @param int $pageConditionGroupUid The uid of the page condition group
     * @return PageConditionGroup[]
     */
    public function findByParentId($pageConditionGroupUid)
    {
        $pageConditionRules = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                item,
                item_option,
                item_option_additional,
                operator
            ',
            'tx_pbsurvey_page_condition_rule',
            '
                parentid = ' . (int)$pageConditionGroupUid . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $pageConditionRules;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $pageConditionRules[] = $this->setPageConditionRuleFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $pageConditionRules;
    }

    /**
     * Set an page condition rule from a database record
     *
     * @param array $record The database record
     * @return PageConditionRule The page condition rule
     */
    protected function setPageConditionRuleFromRecord($record)
    {
        /** @var PageConditionRule $pageConditionRule */
        $pageConditionRule = GeneralUtility::makeInstance(PageConditionRule::class);
        $pageConditionRule->populate($record);

        $this->pageConditionRuleProvider->addSingle($pageConditionRule);

        return $pageConditionRule;
    }
}