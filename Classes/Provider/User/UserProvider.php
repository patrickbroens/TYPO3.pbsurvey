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

use PatrickBroens\Pbsurvey\Domain\Model\FrontendUser;
use PatrickBroens\Pbsurvey\Domain\Model\Result;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * User provider
 */
class UserProvider
{
    /**
     * The amount of finished results
     *
     * @var int
     */
    protected $finishedAmount;

    /**
     * The frontend user (only when logged in)
     *
     * @var FrontendUser
     */
    protected $frontendUser;

    /**
     * The last result
     *
     * @var Result
     */
    protected $lastResult;

    /**
     * The current result
     *
     * @var Result
     */
    protected $result;

    /**
     * The amount of results
     *
     * @var int
     */
    protected $resultAmount;

    /**
     * The session key
     *
     * @var string
     */
    protected $sessionKey;

    /**
     * Get the number of finished results
     *
     * @return int
     */
    public function getFinishedAmount()
    {
        return $this->finishedAmount;
    }

    /**
     * Set the number of finished results
     *
     * @param int $finishedAmount The number
     */
    public function setFinishedAmount($finishedAmount)
    {
        $this->finishedAmount = (int)$finishedAmount;
    }

    /**
     * Check if user is a logged in user
     *
     * @return bool
     */
    public function hasFrontendUser()
    {
        return $this->frontendUser instanceof FrontendUser;
    }

    /**
     * Get the frontend user
     *
     * @return FrontendUser
     */
    public function getFrontendUser()
    {
        return $this->frontendUser;
    }

    /**
     * Set the frontend user
     *
     * @param FrontendUser $frontendUser The frontend user
     */
    public function setFrontendUser(FrontendUser $frontendUser)
    {
        $this->frontendUser = $frontendUser;
    }

    /**
     * Check if there is a last result
     *
     * @return bool
     */
    public function hasLastResult()
    {
        return !empty($this->lastResult);
    }

    /**
     * Get the last result
     *
     * @return Result
     */
    public function getLastResult()
    {
        return $this->lastResult;
    }

    /**
     * Set the last result
     *
     * @param null|Result $lastResult The last result
     */
    public function setLastResult($lastResult)
    {
        if ($lastResult instanceof Result) {
            $this->lastResult = $lastResult;
        }
    }

    /**
     * Check if there is a result
     *
     * @return bool
     */
    public function hasResult()
    {
        return !empty($this->result);
    }

    /**
     * Get the current result
     *
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the current result
     *
     * @param Result $result The result
     */
    public function setResult(Result $result)
    {
        $this->result = $result;
    }

    /**
     * Get the amount of results
     *
     * @return int
     */
    public function getResultAmount()
    {
        return $this->resultAmount;
    }

    /**
     * Set the amount of results
     *
     * @param int $resultAmount The amount
     */
    public function setResultAmount($resultAmount)
    {
        $this->resultAmount = (int)$resultAmount;
    }

    /**
     * Check if there is a session
     *
     * @return bool
     */
    public function hasSession()
    {
        $session = false;

        if ($this->getFrontendUserAuthentication()->getKey('ses', $this->sessionKey) !== null) {
            $session = true;
        }

        return $session;
    }

    /**
     * Get the session key
     *
     * @return string
     */
    public function getSessionKey()
    {
        return $this->sessionKey;
    }

    /**
     * Set the session key
     *
     * @param string $sessionKey The session key
     */
    public function setSessionKey($sessionKey)
    {
        $this->sessionKey = (string)$sessionKey;
    }

    /**
     * Start a session
     *
     * Fill the session with new data
     *
     * Only in the following access levels it is possible to update
     * 1: Single Response
     * 3: Single Response (Not Updateable after finish)
     *
     * Sets the stage to where the respondent left the survey if enteringStage === 1
     *
     * @param ConfigurationProvider $configuration The configuration
     */
    public function startSession(ConfigurationProvider $configuration)
    {
        $resultUid = $stage = 0;

        if (
            // Only access level 1 and 3 can update
            $this->hasLastResult()
            && (
                $configuration->getAccessLevel() === 1
                || $configuration->getAccessLevel() === 3
            )
        )
        {
            $resultUid = $this->getLastResult()->getUid();
            $this->setResult($this->getLastResult());

            // Set the stage where the respondent left the survey
            if ($configuration->getEnteringStage() === 1) {
                $stage = end($this->result->getStages())->getNumber();
            }
        }

        $sessionData = [
            'result' => $resultUid,
            'stage' => $stage
        ];

        $this->setSessionData($sessionData);
    }

    /**
     * Continue an existing session
     *
     * If the "back" button has been pushed, we go back in stage
     *
     * @param ServerRequest $serverRequest The server request
     */
    public function continueSession(ServerRequest $serverRequest)
    {
        if ($this->hasLastResult()) {
            $this->setResult($this->getLastResult());
        }

        if (
            isset($serverRequest->getQueryParams()[$this->sessionKey])
            && isset($serverRequest->getQueryParams()[$this->sessionKey]['back'])
        ) {
            $newStage = $this->result->getPreviousStage($this->getStageNumber());
            $this->setStageNumber($newStage->getNumber());
        }
    }

    /**
     * Get the result uid
     *
     * @return int
     */
    public function getResultUid()
    {
        return $this->getSessionData()['result'];
    }

    /**
     * Set the result uid
     *
     * @param int $result The result uid
     */
    public function setResultUid($result)
    {
        $sessionData = $this->getSessionData();

        $sessionData['result'] = (int)$result;

        $this->setSessionData($sessionData);
    }

    /**
     * Get the page number
     *
     * This is the stage number + 1
     *
     * @return int
     */
    public function getPageNumber()
    {
        return $this->getStageNumber() + 1;
    }

    /**
     * Get the stage number
     *
     * @return int
     */
    public function getStageNumber()
    {
        return $this->getSessionData()['stage'];
    }

    /**
     * Set the stage
     *
     * @param int $stage The stage
     */
    public function setStageNumber($stage)
    {
        $sessionData = $this->getSessionData();

        $sessionData['stage'] = (int)$stage;

        $this->setSessionData($sessionData);
    }

    /**
     * Get the session data
     *
     * @return array
     */
    protected function getSessionData()
    {
        return $this->getFrontendUserAuthentication()->getSessionData($this->sessionKey);
    }

    /**
     * Set the session data
     *
     * @param array $sessionData The session data
     */
    protected function setSessionData(array $sessionData)
    {
        $this->getFrontendUserAuthentication()->setAndSaveSessionData($this->sessionKey, $sessionData);
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