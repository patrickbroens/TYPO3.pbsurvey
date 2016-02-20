<?php
namespace PatrickBroens\Pbsurvey\Survey;

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

use PatrickBroens\Pbsurvey\Domain\Model\PageConditionGroup;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Page condition group provider
 */
class PageConditionGroupProvider implements SingletonInterface
{
    /**
     * The page condition groups
     *
     * @var PageConditionGroup[]
     */
    protected $pageConditionGroups = [];

    /**
     * Add a page condition group
     *
     * @param PageConditionGroup $pageConditionGroup The page condition group
     */
    public function addSingle(PageConditionGroup $pageConditionGroup)
    {
        $this->pageConditionGroups[$pageConditionGroup->getUid()] = $pageConditionGroup;
    }

    /**
     * Find a condition group by its uid
     *
     * @param int $uid
     * @return null|PageConditionGroup
     */
    public function findByUid($uid)
    {
        $pageConditionGroup = null;

        if (isset($this->pageConditionGroups[$uid])) {
            $pageConditionGroup = $this->pageConditionGroups[$uid];
        }

        return $pageConditionGroup;
    }
}