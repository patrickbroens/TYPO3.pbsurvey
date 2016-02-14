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
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Domain\Repository\ItemRepository;

/**
 * Page repository
 */
class PageRepository extends AbstractRepository
{
    public function findBeforePage($pageUid, $loadObjects = [])
    {
        $pages = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                p1.uid,
                p1.condition_groups,
                p1.introduction,
                p1.items,
                p1.title
            ',
            '
                tx_pbsurvey_page AS p1,
                (
                    SELECT tx_pbsurvey_page.pid,tx_pbsurvey_page.sorting
                    FROM tx_pbsurvey_page
                    WHERE tx_pbsurvey_page.uid = ' . (int)$pageUid . '
                ) AS p2
            ',
            '
                p1.sorting < p2.sorting
                AND p1.pid = p2.pid
                AND p1.hidden = 0
                AND p1.deleted = 0
            ',
            '',
            'p1.sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $pages;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $pages[] = $this->setPageFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $pages;
    }
    /**
     * Get the pages before the page which contains a certain condition group
     *
     * @var int $groupUid The uid of the page condition group
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Page[] The pages
     */
    public function findBeforePageByConditionGroup($groupUid, $loadObjects = [])
    {
        $pages = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                p1.uid,
                p1.condition_groups,
                p1.introduction,
                p1.items,
                p1.title
            ',
            '
                tx_pbsurvey_page AS p1,
                (
                    SELECT tx_pbsurvey_page.pid, tx_pbsurvey_page.sorting
                    FROM tx_pbsurvey_page_condition_group
                    JOIN tx_pbsurvey_page
                    ON tx_pbsurvey_page.uid = tx_pbsurvey_page_condition_group.parentid
                    WHERE tx_pbsurvey_page_condition_group.uid = ' . (int)$groupUid . '
                ) AS p2
            ',
            '
                p1.sorting < p2.sorting
                AND p1.pid = p2.pid
                AND p1.hidden = 0
                AND p1.deleted = 0
            ',
            '',
            'p1.sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $pages;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $pages[] = $this->setPageFromRecord($record, $loadObjects);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $pages;
    }

    /**
     * Set a page from a database record
     *
     * @param array $record The database record
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Page The page
     */
    protected function setPageFromRecord($record, $loadObjects)
    {
        /** @var \PatrickBroens\Pbsurvey\Domain\Model\Page $page */
        $page = GeneralUtility::makeInstance(Page::class);
        $page->fill($record);

        if (in_array('Item', $loadObjects)) {
            $page->addItems($this->getItems($page, $loadObjects));
        }

        if (in_array('PageConditionGroup', $loadObjects)) {
            $page->addConditionGroups($this->getConditionGroups($page, $loadObjects));
        }

        return $page;
    }

    /**
     * Get the page items
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Page $page The page
     * @param array $loadObjects The nested objects which should be loaded
     * @return array The page items
     */
    protected function getItems($page, $loadObjects) {
        $itemRepository = GeneralUtility::makeInstance(ItemRepository::class);
        return $itemRepository->findByPage($page->getUid(), $loadObjects);
    }

    /**
     * Get the page condition groups
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Page $page The page
     * @param array $loadObjects The nested objects which should be loaded
     * @return \PatrickBroens\Pbsurvey\Domain\Model\PageConditionGroup[] The page condition groups
     */
    protected function getConditionGroups($page, $loadObjects) {
        $pageConditionGroupRepository = GeneralUtility::makeInstance(PageConditionGroupRepository::class);
        return $pageConditionGroupRepository->findByPage($page->getUid(), $loadObjects);
    }
}