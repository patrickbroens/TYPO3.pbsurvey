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

use PatrickBroens\Pbsurvey\Provider\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Access dispatcher
 */
class AccessDispatcher extends AbstractController
{
    /**
     * Dispatch on error
     *
     * @param AccessProvider $access The access provider
     * @param ConfigurationProvider $configuration The configuration provider
     * @param UserProvider $user The user provider
     * @return string The rendered view
     */
    public function dispatch(
        AccessProvider $access,
        ConfigurationProvider $configuration,
        UserProvider $user
    )
    {
        $controllerName = $access->getErrorControllerName();

        $accessController = GeneralUtility::makeInstance(
            $controllerName,
            $access,
            $configuration,
            $user
        );

        return $accessController->indexAction();
    }
}