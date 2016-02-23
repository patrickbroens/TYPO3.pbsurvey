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

use PatrickBroens\Pbsurvey\Provider\Access\AccessInitializer;
use PatrickBroens\Pbsurvey\Provider\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationInitializer;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\ElementInitializer;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserInitializer;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
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
        $serverRequest = $this->initializeServerRequest();
        $configurationProvider = $this->initializeConfiguration($typoScriptConfiguration);
        $pageProvider = $this->initializeElements($configurationProvider);
        $userProvider = $this->initializeUser($configurationProvider, $serverRequest);
        $accessProvider = $this->initializeAccess($configurationProvider, $pageProvider, $userProvider);
var_dump($accessProvider);exit;
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

    /**
     * Initialize the server request
     *
     * @return ServerRequest
     */
    protected function initializeServerRequest()
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * Initialize the configuration
     *
     * This will be constructed from TypoScript and content element settings
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @return ConfigurationProvider
     */
    protected function initializeConfiguration(array $typoScriptConfiguration)
    {
        /** @var ConfigurationInitializer ConfigurationInitializer */
        $configurationInitializer = GeneralUtility::makeInstance(ConfigurationInitializer::class);
        return $configurationInitializer->initialize(
            $typoScriptConfiguration,
            $this->cObj->data
        );
    }

    /**
     * Initialize the elements
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @return PageProvider
     */
    protected function initializeElements(ConfigurationProvider $configurationProvider)
    {
        /** @var ElementInitializer elementInitializer */
        $elementInitializer = GeneralUtility::makeInstance(ElementInitializer::class);
        return $elementInitializer->initialize($configurationProvider->getStorageFolder());
    }

    /**
     * Initialize the user
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param ServerRequest $serverRequest The server request
     * @return UserProvider
     */
    protected function initializeUser(
        ConfigurationProvider $configurationProvider,
        ServerRequest $serverRequest
    )
    {
        /** @var UserInitializer $userInitializer */
        $userInitializer = GeneralUtility::makeInstance(UserInitializer::class);
        return $userInitializer->initialize($configurationProvider, $serverRequest);
    }

    /**
     * Initialize the access
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param PageProvider $pageProvider The page provider
     * @param UserProvider $userProvider The user provider
     * @return AccessProvider
     */
    protected function initializeAccess(
        ConfigurationProvider $configurationProvider,
        PageProvider $pageProvider,
        UserProvider $userProvider
    )
    {
        /** @var AccessInitializer $accessInitializer */
        $accessInitializer = GeneralUtility::makeInstance(AccessInitializer::class);
        return $accessInitializer->initialize($configurationProvider, $pageProvider, $userProvider);
    }


}