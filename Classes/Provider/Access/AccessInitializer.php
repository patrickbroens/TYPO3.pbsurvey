<?php
namespace PatrickBroens\Pbsurvey\Provider\Access;

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

use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Access initializer
 */
class AccessInitializer
{
    /**
     * Initialize the access initializer
     *
     * Set the access provider and emit a signal to populate
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param PageProvider $pageProvider The page provider
     * @param UserProvider $userProvider The user provider
     * @return AccessProvider
     */
    public function initialize(
        ConfigurationProvider $configurationProvider,
        PageProvider $pageProvider,
        UserProvider $userProvider
    )
    {
        /** @var AccessProvider $accessProvider */
        $accessProvider = GeneralUtility::makeInstance(AccessProvider::class);

        $this->emitCheckAccessSignal(
            $accessProvider,
            $configurationProvider,
            $pageProvider,
            $userProvider
        );

        return $accessProvider;
    }

    /**
     * Emit signal to check the access to the survey
     *
     * @param AccessProvider $accessProvider The access provider
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param PageProvider $pageProvider The page provider
     * @param UserProvider $userProvider The user provider
     */
    protected function emitCheckAccessSignal(
        AccessProvider $accessProvider,
        ConfigurationProvider $configurationProvider,
        PageProvider $pageProvider,
        UserProvider $userProvider
    )
    {
        $signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcher->dispatch(
            __CLASS__,
            'AccessCheck',
            [
                $accessProvider,
                $configurationProvider,
                $pageProvider,
                $userProvider
            ]
        );

        $accessProvider->setAccess(!$accessProvider->hasError());
    }
}