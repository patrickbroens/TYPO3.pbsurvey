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

use PatrickBroens\Pbsurvey\Access\AccessManager;
use PatrickBroens\Pbsurvey\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Configuration\ApplicationConfiguration;
use PatrickBroens\Pbsurvey\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Dispatcher
 */
class Dispatcher
{
    /**
     * The content object renderer
     *
     * This value is magically set by the content element
     *
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * The application configuration
     *
     * @var ApplicationConfiguration
     */
    protected $configuration;

    /**
     * The access provider
     *
     * @var AccessProvider
     */
    protected $accessProvider;

    /**
     * Executes the dispatcher
     *
     * @param string $content The content string
     * @param array $typoScriptConfiguration TypoScript configuration
     * @return string The rendered view
     */
    public function execute($content, array $typoScriptConfiguration)
    {
        $controllerName = '';

        $this->setConfiguration($typoScriptConfiguration);

        if (!$this->hasAccess()) {
            $controllerName = $this->accessProvider->getErrorControllerName();
        }


        return $this->dispatch($controllerName);
    }

    /**
     * Dispatch
     *
     * @return string $controllerName The controller class
     * @return string The rendered view
     */
    protected function dispatch($controllerName)
    {
        $controller = GeneralUtility::makeInstance($controllerName);
        $output = $controller->indexAction();

        return $output;
    }

    /**
     * Check if the respondent has access to the survey
     *
     * @return bool true if access is provided
     */
    protected function hasAccess()
    {
        /** @var AccessManager $accessManager */
        $accessManager = GeneralUtility::makeInstance(AccessManager::class);
        $this->accessProvider = $accessManager->getAccessProvider();

        return $this->accessProvider->hasAccess();
    }

    /**
     * Populate the application configuration with TypoScript and content element configuration
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     */
    protected function setConfiguration(array $typoScriptConfiguration)
    {
        /** @var ConfigurationManager configurationManager */
        $configurationManager = GeneralUtility::makeInstance(
            ConfigurationManager::class,
            $typoScriptConfiguration,
            $this->cObj->data
        );

        $configurationManager->populate();

        $this->configuration = $configurationManager->getConfiguration();
    }
}