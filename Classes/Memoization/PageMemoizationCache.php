<?php
namespace PatrickBroens\Pbsurvey\Memoization;

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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\Page;

/**
 * Page memoization cache
 *
 * For all of you folks who don't know what memoization is:
 * An optimization technique used primarily to speed up computer programs
 * by storing the results of expensive function calls
 * and returning the cached result when the same inputs occur again.
 * @see: https://en.wikipedia.org/wiki/Memoization
 *
 * TCA 'user' type and itemProcFunc sometimes need the same page(s) from the database within runtime
 * so we store it in the memoization cache, or runtime cache.
 */
class PageMemoizationCache implements SingletonInterface
{
    /**
     * Storage of pages before a page
     *
     * @var array
     */
    protected $pagesBeforePage = [];

    /**
     * Pages storage of pages before another page based on the condition group
     *
     * @var array
     */
    protected $pagesBeforePageByConditionGroup = [];

    /**
     * Check if pages are in cache which are before a certain page
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return bool
     */
    public function hasPagesBeforePage($pageUid, array $loadObjects)
    {
        $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

        return (
            isset($this->pagesBeforePage[$pageUid])
            && isset($this->pagesBeforePage[$pageUid][$objectsIdentifier])
        );
    }

    /**
     * Check if pages are in cache which are before a certain page based on a condition group
     *
     * @param int $conditionGroupUid The uid of the condition group
     * @param array $loadObjects The nested models which should be loaded
     * @return bool
     */
    public function hasPagesBeforePageByConditionGroup($conditionGroupUid, array $loadObjects)
    {
        $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

        return (
            isset($this->pagesBeforePageByConditionGroup[$conditionGroupUid])
            && isset($this->pagesBeforePageByConditionGroup[$conditionGroupUid][$objectsIdentifier])
        );
    }

    /**
     * Get pages from the cache
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return null|Page[] Pages when in cache
     */
    public function getPagesBeforePage($pageUid, array $loadObjects)
    {
        $pagesBeforePage = [];

        if ($this->hasPagesBeforePage($pageUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            $pagesBeforePage = $this->pagesBeforePage[$pageUid][$objectsIdentifier];
        }

        return $pagesBeforePage;
    }

    /**
     * Get pages from the cache which are before a certain page based on a condition group
     *
     * @param int $conditionGroupUid The uid of the condition group
     * @param array $loadObjects The nested models which should be loaded
     * @return null|Page[] Pages when in cache
     */
    public function getPagesBeforePageByConditionGroup($conditionGroupUid, array $loadObjects)
    {
        $pagesBeforePageByConditionGroup = [];

        if ($this->hasPagesBeforePageByConditionGroup($conditionGroupUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            $pagesBeforePageByConditionGroup = $this->pagesBeforePageByConditionGroup[$conditionGroupUid][$objectsIdentifier];
        }

        return $pagesBeforePageByConditionGroup;
    }

    /**
     * Store pages in the cache
     *
     * @param int $pageUid The uid of the survey page
     * @param Page[] $pagesBeforePage The pages before a page
     * @param array $loadObjects The nested models which should be loaded
     */
    public function storePagesBeforePage($pageUid, $pagesBeforePage, array $loadObjects)
    {
        if (!$this->hasPagesBeforePage($pageUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            if (!isset($this->pagesBeforePage[$pageUid])) {
                $this->pagesBeforePage[$pageUid] = [
                    $objectsIdentifier => $pagesBeforePage
                ];
            } else {
                $this->pagesBeforePage[$pageUid][$objectsIdentifier] = $pagesBeforePage;
            }
        }
    }

    /**
     * Store pages in the cache which are before a certain page based on a condition group
     *
     * @param int $conditionGroupUid The uid of the condition group
     * @param Page[] $pagesBeforePageByConditionGroup The pages before a page
     * @param array $loadObjects The nested models which should be loaded
     */
    public function storePagesBeforePageByConditionGroup($conditionGroupUid, $pagesBeforePageByConditionGroup, array $loadObjects)
    {
        if (!$this->hasPagesBeforePageByConditionGroup($conditionGroupUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            if (!isset($this->pagesBeforePageByConditionGroup[$conditionGroupUid])) {
                $this->pagesBeforePageByConditionGroup[$conditionGroupUid] = [
                    $objectsIdentifier => $pagesBeforePageByConditionGroup
                ];
            } else {
                $this->pagesBeforePageByConditionGroup[$conditionGroupUid][$objectsIdentifier] = $pagesBeforePageByConditionGroup;
            }
        }
    }

    /**
     * Get the objects identifier
     *
     * @param array $loadObjects The nested models which should be loaded
     * @return string
     */
    protected function getObjectsIdentifier(array $loadObjects)
    {
        if (empty($loadObjects)) {
            $objectIdentifier = 'none';
        } else {
            $objectIdentifier = implode('_', asort($loadObjects));
        }

        return $objectIdentifier;
    }
}