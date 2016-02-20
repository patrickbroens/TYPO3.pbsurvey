<?php
namespace PatrickBroens\Pbsurvey\DataProvider;

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

use PatrickBroens\Pbsurvey\Domain\Model\PageConditionRule;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Page condition rule provider
 */
class PageConditionRuleProvider
{
    /**
     * The page condition rules
     *
     * @var PageConditionRule[]
     */
    protected $pageConditionRules = [];

    /**
     * Add a page condition rule
     *
     * @param PageConditionRule $pageConditionRule The page condition rule
     */
    public function addSingle(PageConditionRule $pageConditionRule)
    {
        $this->pageConditionRules[$pageConditionRule->getUid()] = $pageConditionRule;
    }
}