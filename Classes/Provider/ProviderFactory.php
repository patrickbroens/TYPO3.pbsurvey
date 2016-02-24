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

use PatrickBroens\Pbsurvey\Provider\Access\AccessFactory;
use PatrickBroens\Pbsurvey\Provider\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationFactory;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\ElementFactory;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserInitializer;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Central point to get all providers
 */
class ProviderFactory
{
    /**
     * Get the server request
     *
     * @return ServerRequest
     */
    public static function getServerRequest()
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * Get the configuration
     *
     * This will be constructed from TypoScript and content element settings
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param ContentObjectRenderer $contentObjectRenderer The content object renderer
     * @return ConfigurationProvider
     */
    public static function getConfiguration(
        array $typoScriptConfiguration,
        ContentObjectRenderer $contentObjectRenderer
    )
    {
        /** @var ConfigurationFactory $configurationFactory */
        $configurationFactory = GeneralUtility::makeInstance(ConfigurationFactory::class);
        return $configurationFactory->initialize(
            $typoScriptConfiguration,
            $contentObjectRenderer->data
        );
    }

    /**
     * Get the elements
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @return PageProvider
     */
    public static function getElements(ConfigurationProvider $configurationProvider)
    {
        /** @var ElementFactory $elementFactory */
        $elementFactory = GeneralUtility::makeInstance(ElementFactory::class);
        return $elementFactory->initialize($configurationProvider->getStorageFolder());
    }

    /**
     * Get the user
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param ServerRequest $serverRequest The server request
     * @return UserProvider
     */
    public static function getUser(
        ConfigurationProvider $configurationProvider,
        ServerRequest $serverRequest
    )
    {
        /** @var UserInitializer $userInitializer */
        $userInitializer = GeneralUtility::makeInstance(UserInitializer::class);
        return $userInitializer->initialize($configurationProvider, $serverRequest);
    }

    /**
     * Get the access
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param PageProvider $pageProvider The page provider
     * @param UserProvider $userProvider The user provider
     * @return AccessProvider
     */
    public static function getAccess(
        ConfigurationProvider $configurationProvider,
        PageProvider $pageProvider,
        UserProvider $userProvider
    )
    {
        /** @var AccessFactory $accessFactory */
        $accessFactory = GeneralUtility::makeInstance(AccessFactory::class);
        return $accessFactory->initialize($configurationProvider, $pageProvider, $userProvider);
    }
}