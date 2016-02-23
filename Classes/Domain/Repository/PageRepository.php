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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Domain\Model\PageConditionGroup;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Page repository
 */
class PageRepository extends AbstractRepository
{
    /**
     * Find survey pages by pid
     *
     * @param int $pageUid The page uid
     * @return Page[]
     */
    public function findByPid($pageUid = 0)
    {
        $pages = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                condition_groups,
                introduction,
                items,
                title
            ',
            'tx_pbsurvey_page',
            '
                pid = ' . (int)$pageUid . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);

            return $pages;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $pages[] = $this->setPageFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $pages;
    }

    /**
     * Set a page from a database record
     *
     * @param array $record The database record
     * @return Page The page
     */
    protected function setPageFromRecord($record)
    {
        /** @var Page $page */
        $page = GeneralUtility::makeInstance(Page::class);
        $page->populate($record);

        $page->addItems($this->getItems($page));
        $page->addConditionGroups($this->getConditionGroups($page));

        return $page;
    }

    /**
     * Get the page items
     *
     * @param Page $page The page
     * @return AbstractItem[] The page items
     */
    protected function getItems($page) {
        $itemRepository = GeneralUtility::makeInstance(ItemRepository::class);
        return $itemRepository->findByParentId($page->getUid());
    }

    /**
     * Get the page condition groups
     *
     * @param Page $page The page
     * @return PageConditionGroup[] The page condition groups
     */
    protected function getConditionGroups($page) {
        $pageConditionGroupRepository = GeneralUtility::makeInstance(PageConditionGroupRepository::class);
        return $pageConditionGroupRepository->findByParentId($page->getUid());
    }
}