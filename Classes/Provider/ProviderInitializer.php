<?php
namespace PatrickBroens\Pbsurvey\Provider;

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
 * Provider initializer
 */
class ProviderInitializer
{
    /**
     * Initialize the server request
     *
     * @return ServerRequest
     */
    public static function initializeServerRequest()
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * Initialize the configuration
     *
     * This will be constructed from TypoScript and content element settings
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param ContentObjectRenderer $contentObjectRenderer The content object renderer
     * @return ConfigurationProvider
     */
    public static function initializeConfiguration(
        array $typoScriptConfiguration,
        ContentObjectRenderer $contentObjectRenderer
    )
    {
        /** @var ConfigurationInitializer ConfigurationInitializer */
        $configurationInitializer = GeneralUtility::makeInstance(ConfigurationInitializer::class);
        return $configurationInitializer->initialize(
            $typoScriptConfiguration,
            $contentObjectRenderer->data
        );
    }

    /**
     * Initialize the elements
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @return PageProvider
     */
    public static function initializeElements(ConfigurationProvider $configurationProvider)
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
    public static function initializeUser(
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
    public static function initializeAccess(
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