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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Provider\Element\ElementInitializer;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Abstract control
 */
class Control
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
     * The element initializer
     *
     * @var ElementInitializer
     */
    protected $elementInitializer;

    /**
     * The page provider
     *
     * @var PageProvider
     */
    protected $pageProvider;

    /**
     * Constructor
     *
     * Set the view
     */
    public function __construct()
    {
        $this->setView(static::$templateRootPaths);

        $this->elementInitializer = GeneralUtility::makeInstance(ElementInitializer::class);
    }

    /**
     * Initialize the element provider and set the page provider
     *
     * @param int $storagePage The page uid where the element initializer has to collect the data
     */
    public function setPageProvider($storagePage)
    {
        $this->pageProvider = $this->elementInitializer->initialize((int)$storagePage);
    }

    /**
     * Get an item by its uid
     *
     * @param int $uid The uid of the item
     * @return null|AbstractQuestion
     */
    protected function getItemByUid($uid)
    {
        $output = null;

        $pages = $this->pageProvider->getPages();

        foreach ($pages as $page) {
            if ($page->hasItems()) {
                foreach($page->getItems() as $item) {
                    if (
                        $item instanceof AbstractQuestion
                        && $item->getUid() === $uid
                    ) {
                        $output = $item;
                    }
                }
            }
        }

        return $output;
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