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
use PatrickBroens\Pbsurvey\Domain\Model\Item;

/**
 * Abstract to control survey pages
 */
class PageControl
{
    /**
     * The template root paths
     *
     * @var array
     */
    protected static $templateRootPaths = [];

    /**
     * The view
     *
     * @var StandaloneView
     */
    protected $view;

    /**
     * The page repository
     *
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * Constructor
     *
     * Set the page repository and the view
     */
    public function __construct()
    {
        $this->setView(static::$templateRootPaths);
        $this->pageRepository = GeneralUtility::makeInstance(PageRepository::class);
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

                /** @var Item $item */
                foreach($page->getItems() as $item) {
                    if ($item->isQuestion()) {
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

    /**
     * Set the view
     *
     * @param array $templateRootPaths The template root paths
     */
    protected function setView($templateRootPaths)
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setTemplateRootPaths($templateRootPaths);
    }

    /**
     * Get the language service
     *
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}