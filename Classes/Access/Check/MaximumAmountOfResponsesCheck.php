<?php
namespace PatrickBroens\Pbsurvey\Access\Check;

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

use PatrickBroens\Pbsurvey\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Domain\Repository\ResultRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Access check if the maximum amount of responses has been reached
 */
class MaximumAmountOfResponsesCheck implements AccessCheckInterface
{
    /**
     * The error controller name
     */
    const ERROR_CONTROLLER_NAME = 'PatrickBroens\Pbsurvey\Controller\Access\MaximumAmountOfResponsesErrorController';

    /**
     * Check if the maximum amount of responses to the survey has been reached
     *
     * @param AccessProvider $accessProvider The access provider
     * @param ConfigurationProvider $configurationProvider The configuration provider
     */
    public function check(
        AccessProvider $accessProvider,
        ConfigurationProvider $configurationProvider
    )
    {
        // Skip if there is already an error
        if (!$accessProvider->hasError()) {
            $storageFolderUid = $configurationProvider->getStorageFolder();

            $maximumAmount = $configurationProvider->getMaximumResponses();

            $resultRepository = GeneralUtility::makeInstance(ResultRepository::class);
            $finishedResults = $resultRepository->countByStorageFolder($storageFolderUid);

            if (
                $finishedResults >= $maximumAmount
                && $maximumAmount !== 0
            ) {
                $accessProvider->setError(true);
                $accessProvider->setErrorControllerName(self::ERROR_CONTROLLER_NAME);
            }
        }
    }
}