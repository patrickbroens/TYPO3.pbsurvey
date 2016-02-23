<?php
namespace PatrickBroens\Pbsurvey\Provider\User;

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
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * user initializer
 */
class UserInitializer
{
    /**
     * Initialize the user initializer
     *
     * Make instance of the user provider and emit a signal to populate
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param ServerRequest $serverRequest The server request
     * @return UserProvider
     */
    public function initialize(
        ConfigurationProvider $configurationProvider,
        ServerRequest $serverRequest
    )
    {
        /** @var UserProvider $userProvider */
        $userProvider = GeneralUtility::makeInstance(UserProvider::class);

        $this->emitUserPopulateSignal(
            $userProvider,
            $configurationProvider,
            $serverRequest
        );

        return $userProvider;
    }

    /**
     * Emit signal to populate the user
     *
     * @param UserProvider $userProvider The user provider
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param ServerRequest $serverRequest The server request
     */
    protected function emitUserPopulateSignal(
        UserProvider $userProvider,
        ConfigurationProvider $configurationProvider,
        ServerRequest $serverRequest
    )
    {
        $signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcher->dispatch(
            __CLASS__,
            'UserPopulate',
            [
                $userProvider,
                $configurationProvider,
                $serverRequest
            ]
        );
    }
}