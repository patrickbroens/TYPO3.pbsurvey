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
use PatrickBroens\Pbsurvey\Domain\Repository\ResultRepository;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use PatrickBroens\Pbsurvey\Utility\ArrayUtility;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * User populator for the results
 */
class ResultPopulate implements UserPopulateInterface
{
    /**
     * Populate the user with result data
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
        $resultRepository = GeneralUtility::makeInstance(ResultRepository::class);
        $storageFolder = $configurationProvider->getStorageFolder();

        $result = null;
        $countFinished = $countResults = 0;

        if ($userProvider->hasFrontendUser()) {
            // Get the result based on a logged in user

            $frontendUser = $userProvider->getFrontendUser();
            $resultUid = $this->getFrontendUserAuthentication()->getKey(
                'user',
                'pbsurvey_' . $configurationProvider->getUid()
            );

            $result = $resultRepository->findByUid($resultUid);
            $countFinished = $resultRepository->countFinishedByFrontendUser($frontendUser, $storageFolder);
            $countResults = $resultRepository->countByFrontendUser($frontendUser, $storageFolder);

        } elseif ($configurationProvider->getAnonymousMode() === 1) {
            // Get the result based on a cookie

            $cookieParameters = $serverRequest->getCookieParams();
            if (isset($cookieParameters['pbsurvey_' . $configurationProvider->getUid()])) {
                $cookie = $cookieParameters['pbsurvey_' . $configurationProvider->getUid()];
                $resultUid = (int)end(array_keys($cookie));

                $result = $resultRepository->findByUid($resultUid);
                $countFinished = ArrayUtility::countByKeyword(
                    $cookie,
                    '1'
                );
                $countResults = count($cookie);
            }

        } else {
            // Get the result based on IP address

            $ipAddress = $serverRequest->getServerParams()['REMOTE_ADDR'];

            $result = $resultRepository->findLatestByIp($ipAddress, $storageFolder);
            $countFinished = $resultRepository->countFinishedByIp($ipAddress, $storageFolder);
            $countResults = $resultRepository->countByIp($ipAddress, $storageFolder);
        }

        if ($result) {
            $userProvider->setLastResult($result->getUid());
        }

        $userProvider->setFinishedAmount($countFinished);
        $userProvider->setResultAmount($countResults);
    }

    /**
     * Get the frontend user authentication
     *
     * @return FrontendUserAuthentication
     */
    protected function getFrontendUserAuthentication()
    {
        return $this->getTypoScriptFrontendController()->fe_user;
    }

    /**
     * Get the TypoScript frontend controller
     *
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}