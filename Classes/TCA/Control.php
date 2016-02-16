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
     * Constructor
     *
     * Set the view
     */
    public function __construct()
    {
        $this->setView(static::$templateRootPaths);
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