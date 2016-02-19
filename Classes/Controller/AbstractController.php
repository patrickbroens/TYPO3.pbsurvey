<?php
namespace PatrickBroens\Pbsurvey\Controller;

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

use PatrickBroens\Pbsurvey\Configuration\ApplicationConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Install\View\StandaloneView;

/**
 * Abstract controller
 */
abstract class AbstractController
{
    /**
     * The application configuration
     *
     * @var ApplicationConfiguration
     */
    protected $configuration;

    /**
     * The view
     *
     * @var StandaloneView
     */
    protected $view;

    /**
     * Constructor
     *
     * Set the configuration and the view
     */
    public function __construct()
    {
        $this->configuration = GeneralUtility::makeInstance(ApplicationConfiguration::class);

        $this->setView();
    }

    /**
     * Set the view
     */
    protected function setView()
    {
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
        $this->view->setTemplateRootPaths($this->configuration->getTemplateRootPaths());
        $this->view->setLayoutRootPaths($this->configuration->getLayoutRootPaths());
        $this->view->setPartialRootPaths($this->configuration->getPartialRootPaths());
    }
}