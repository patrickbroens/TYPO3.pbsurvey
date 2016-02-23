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
     * The amount of results
     *
     * @var int
     */
    protected $resultAmount;

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
}