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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Lang\LanguageService;
use PatrickBroens\Pbsurvey\Domain\Repository\PageRepository;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;

/**
 * Abstract to control survey pages
 */
class PageControl extends Control
{
    /**
     * The page repository
     *
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * Constructor
     *
     * Set the page repository
     */
    public function __construct()
    {
        $this->pageRepository = GeneralUtility::makeInstance(PageRepository::class);

        parent::__construct();
    }

    /**
     * Check if there are questions and not only presentation items in the pages
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Page[] $pagesBeforeCurrentPage The pages
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