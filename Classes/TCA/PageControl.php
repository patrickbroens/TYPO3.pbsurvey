<?php
namespace PatrickBroens\Pbsurvey\TCA;

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

use PatrickBroens\Pbsurvey\DataProvider\PageProvider;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract to control survey pages
 */
class PageControl extends Control
{
    /**
     * The page provider
     *
     * @var PageProvider
     */
    protected $pageProvider;

    /**
     * Initialize the data provider and set the page provider
     *
     * @param int $pageUid The page uid where the dataprovider has to collect the data
     */
    public function setPageProvider($pageUid)
    {
        $this->dataProvider->initialize((int)$pageUid);
        $this->pageProvider = $this->dataProvider->getProvider('page');
    }

    /**
     * Check if there are questions and not only presentation items in the pages
     *
     * @param Page[] $pagesBeforeCurrentPage The pages
     * @return bool true if there are questions
     */
    protected function hasQuestions($pagesBeforeCurrentPage)
    {
        $questionAmount = 0;

        /** @var Page $page */
        foreach ($pagesBeforeCurrentPage as $page) {
            if ($page->hasItems()) {
                /** @var AbstractQuestion $item */
                foreach($page->getItems() as $item) {
                    if (
                        $item instanceof AbstractQuestion
                        && !empty($item->getAllowedConditionOperatorGroups())
                    ) {
                        $questionAmount++;
                    }
                }
            }
        }

        return (bool)$questionAmount;
    }

    /**
     * Render the warning markup when the page record has not been saved yet
     *
     * @return string The warning markup
     */
    protected function renderSaveWarning()
    {
        $this->view->setTemplate('SaveWarning');

        return $this->view->render();
    }
}