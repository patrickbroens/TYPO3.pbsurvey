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
use PatrickBroens\Pbsurvey\Configuration\ApplicationConfiguration;
use PatrickBroens\Pbsurvey\DataProvider\DataProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Access check if there are any pages and items at all
 */
class ItemsAvailabilityCheck
{
    /**
     * The error controller name
     */
    const ERROR_CONTROLLER_NAME = 'PatrickBroens\Pbsurvey\Controller\Access\ItemsAvailabilityErrorController';

    /**
     * Check if the maximum amount of responses to the survey has been reached
     *
     * @param AccessProvider $accessProvider The access provider
     * @param ApplicationConfiguration $configuration The configuration
     */
    public function check(
        AccessProvider $accessProvider,
        ApplicationConfiguration $configuration
    )
    {
        // Skip if there is already an error
        if (!$accessProvider->hasError()) {
            /** @var DataProvider $dataProvider */
            $dataProvider = GeneralUtility::makeInstance(DataProvider::class);
            $pageProvider = $dataProvider->getProvider('page');
            $itemProvider = $dataProvider->getProvider('item');

            $pageCount = $pageProvider->getCount();
            $itemCount = $itemProvider->getCount();

            if (
                $pageCount === 0
                && $itemCount === 0
            ) {
                $accessProvider->setError(true);
                $accessProvider->setErrorControllerName(self::ERROR_CONTROLLER_NAME);
            }
        }
    }
}