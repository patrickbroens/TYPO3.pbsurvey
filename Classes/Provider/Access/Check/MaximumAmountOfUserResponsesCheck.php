<?php
namespace PatrickBroens\Pbsurvey\Provider\Access\Check;

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
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Access check if the user has filled the maximum amount of finished results
 */
class MaximumAmountOfUserResponsesCheck implements AccessCheckInterface
{
    /**
     * The error controller name
     */
    const ERROR_CONTROLLER_NAME = 'PatrickBroens\Pbsurvey\Controller\Access\MaximumAmountOfUserResponsesErrorController';

    /**
     * Check if the user has filled the maximum amount of finished results
     *
     * @param AccessProvider $accessProvider The access provider
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param PageProvider $pageProvider The page provider
     * @param UserProvider $userProvider The user provider
     * @return
     */
    public function check(
        AccessProvider $accessProvider,
        ConfigurationProvider $configurationProvider,
        PageProvider $pageProvider,
        UserProvider $userProvider
    )
    {
        // Skip if there is already an error
        if (!$accessProvider->hasError()) {
            $respondentAccessLevel = $configurationProvider->getAccessLevel();

            if (
                (
                    $respondentAccessLevel === 0
                    && $userProvider->getFinishedAmount() >= $configurationProvider->getMaximumResponses()
                )
                || (
                    $respondentAccessLevel === 2
                    && $userProvider->getResultAmount() >= 1
                    && $userProvider->getFinishedAmount() === 0
                )
                || (
                    $respondentAccessLevel === 2
                    && $userProvider->getFinishedAmount() >= 1
                )
            ) {
                $accessProvider->setError(true);
                $accessProvider->setErrorControllerName(self::ERROR_CONTROLLER_NAME);
            }
        }
    }
}