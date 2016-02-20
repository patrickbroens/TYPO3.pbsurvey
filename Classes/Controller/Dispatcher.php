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

use PatrickBroens\Pbsurvey\Access\AccessInitializer;
use PatrickBroens\Pbsurvey\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Configuration\ConfigurationInitializer;
use PatrickBroens\Pbsurvey\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Survey\DataInitializer;
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

        $this->initializeProviders($typoScriptConfiguration);

        if (!$this->hasAccess()) {
            $controllerName = $this->accessProvider->getErrorControllerName();
        }

        return $this->dispatch($controllerName);
    }

    /**
     * Dispatch
     *
     * @param string $controllerName The controller class
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
        $this->accessProvider = GeneralUtility::makeInstance(AccessProvider::class);
        return $this->accessProvider->hasAccess();
    }

    /**
     * Initialize providers
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     */
    protected function initializeProviders($typoScriptConfiguration)
    {
        /** @var ConfigurationInitializer ConfigurationInitializer */
        $configurationInitializer = GeneralUtility::makeInstance(ConfigurationInitializer::class);
        $configurationInitializer->initialize($typoScriptConfiguration, $this->cObj->data);
        $configurationProvider = GeneralUtility::makeInstance(ConfigurationProvider::class);

        /** @var DataInitializer dataInitializer */
        $dataInitializer = GeneralUtility::makeInstance(DataInitializer::class);
        $dataInitializer->initialize($configurationProvider->getStorageFolder());

        /** @var AccessInitializer $accessInitializer */
        $accessInitializer = GeneralUtility::makeInstance(AccessInitializer::class);
        $accessInitializer->initialize();
    }
}