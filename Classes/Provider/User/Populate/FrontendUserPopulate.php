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
use PatrickBroens\Pbsurvey\Domain\Model\FrontendUser;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * User populator for the table fe_user
 */
class FrontendUserPopulate implements UserPopulateInterface
{
    /**
     * Populate the user with fields from fe_users table
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
        if ($this->getFrontendUserAuthentication()->user) {
            /** @var FrontendUser $frontendUser */
            $frontendUser = GeneralUtility::makeInstance(FrontendUser::class);
            $frontendUser->populate($this->getFrontendUserAuthentication()->user);

            $userProvider->setFrontendUser($frontendUser);
        }
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