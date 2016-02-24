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
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\ProviderFactory;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Http\ServerRequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Bootstrap
 */
class Bootstrap
{
    /**
     * The content object renderer
     *
     * This value is magically set by the content element
     * Therefor it should remain public
     *
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * Executes the bootstrap
     *
     * @param string $content The content string
     * @param array $typoScriptConfiguration TypoScript configuration
     * @return string The rendered view
     */
    public function execute($content, array $typoScriptConfiguration)
    {
        // Get relevant survey data
        $serverRequest = ProviderFactory::getServerRequest();
        $configuration = ProviderFactory::getConfiguration($typoScriptConfiguration, $this->cObj);
        $pages = ProviderFactory::getElements($configuration);
        $user = ProviderFactory::getUser($configuration, $serverRequest);
        $access = ProviderFactory::getAccess($configuration, $pages, $user);

        if (!$access->hasAccess()) {
            // The user does not have access to the survey
            $content = $this->dispatchOnError(
                $access,
                $configuration,
                $user
            );

        } else {
            // We've got access!
            $content = $this->enterSurvey(
                $serverRequest,
                $configuration,
                $pages,
                $user
            );
        }

        return $content;
    }

    /**
     * Dispatch on error
     *
     * @param AccessProvider $access The access provider
     * @param ConfigurationProvider $configuration The configuration provider
     * @param UserProvider $user The user provider
     * @return string The rendered view
     */
    protected function dispatchOnError(
        AccessProvider $access,
        ConfigurationProvider $configuration,
        UserProvider $user
    )
    {
        /** @var AccessDispatcher $accessDispatcher */
        $accessDispatcher = GeneralUtility::makeInstance(AccessDispatcher::class);
        return $accessDispatcher->dispatch(
            $access,
            $configuration,
            $user
        );
    }

    /**
     * @param ServerRequest $serverRequest The server request
     * @param ConfigurationProvider $configuration The configuration provider
     * @param PageProvider $pages The page provider
     * @param UserProvider $user The user provider
     * @return string The rendered view
     */
    protected function enterSurvey(
        ServerRequest $serverRequest,
        ConfigurationProvider $configuration,
        PageProvider $pages,
        UserProvider $user
    )
    {
        /** @var SurveyController $surveyController */
        $surveyController = GeneralUtility::makeInstance(
            SurveyController::class,
            $serverRequest,
            $configuration,
            $pages,
            $user
        );
        return $surveyController->indexAction();
    }
}