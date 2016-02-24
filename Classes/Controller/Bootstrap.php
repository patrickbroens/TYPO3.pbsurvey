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

use PatrickBroens\Pbsurvey\Provider\ProviderInitializer;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Bootstrap
 */
class Bootstrap
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
     * Executes the bootstrap
     *
     * @param string $content The content string
     * @param array $typoScriptConfiguration TypoScript configuration
     * @return string The rendered view
     */
    public function execute($content, array $typoScriptConfiguration)
    {
        $serverRequest = ProviderInitializer::initializeServerRequest();
        $configurationProvider = ProviderInitializer::initializeConfiguration($typoScriptConfiguration, $this->cObj);
        $pageProvider = ProviderInitializer::initializeElements($configurationProvider);
        $userProvider = ProviderInitializer::initializeUser($configurationProvider, $serverRequest);
        $accessProvider = ProviderInitializer::initializeAccess($configurationProvider, $pageProvider, $userProvider);

        if (!$accessProvider->hasAccess()) {
            $controllerName = $accessProvider->getErrorControllerName();
            $content = $this->dispatch($controllerName);
        }



        return $content;
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
        $content = $controller->indexAction();

        return $content;
    }
}