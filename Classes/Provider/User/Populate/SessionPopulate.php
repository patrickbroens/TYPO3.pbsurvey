<?php
namespace PatrickBroens\Pbsurvey\Provider\User\Populate;

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
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Http\ServerRequest;

/**
 * User populator for the session
 */
class SessionPopulate implements UserPopulateInterface
{
    /**
     * Set the session key
     *
     * @param UserProvider $userProvider The user provider
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param ServerRequest $serverRequest The server request
     */
    public function populate(
        UserProvider $userProvider,
        ConfigurationProvider $configurationProvider,
        ServerRequest $serverRequest
    )
    {
        $userProvider->setSessionKey('pbsurvey_' . $configurationProvider->getUid());
    }
}