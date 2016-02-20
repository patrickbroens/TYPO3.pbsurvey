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

use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Domain\Repository\PageRepository;
use PatrickBroens\Pbsurvey\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Survey page provider
 */
class PageProvider
{
    /**
     * The survey pages
     *
     * @var Page[]
     */
    protected $pages = [];

    /**
     * Add a page
     *
     * @param Page $page The page
     */
    public function addSingle(Page $page)
    {
        $this->pages[$page->getUid()] = $page;
    }

    /**
     * Find pages before a certain page
     *
     * @param int $pageUid The page uid of the page after
     * @return array
     */
    public function findBeforePage($pageUid)
    {
        $positionCurrentPage = ArrayUtility::findPositionByKey($this->pages, $pageUid);

        return array_slice($this->pages, 0, $positionCurrentPage, true);
    }

    /**
     * Get the amount of pages
     *
     * @return int
     */
    public function getCount()
    {
        return count($this->pages);
    }

    /**
     * Populate the page provider and all underlying objects
     */
    public function populate()
    {
        $pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $pageRepository->findByPid();
    }
}