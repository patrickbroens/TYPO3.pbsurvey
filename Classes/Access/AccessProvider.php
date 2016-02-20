<?php
namespace PatrickBroens\Pbsurvey\Access;

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

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Access provider
 */
class AccessProvider implements SingletonInterface
{
    /**
     * Does the respondent have access to the survey?
     *
     * @var bool
     */
    protected $access = false;

    /**
     * Has an error be detected?
     *
     * @var bool
     */
    protected $error = false;

    /**
     * The controller name for the error that has been detected
     *
     * @var string
     */
    protected $errorControllerName = '';

    /**
     * Check if the respondent has access to the survey
     *
     * @return boolean
     */
    public function hasAccess()
    {
        return $this->access;
    }

    /**
     * Set if the respondent has access to the survey
     *
     * @param boolean $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * Check if there is an error
     *
     * @return boolean
     */
    public function hasError()
    {
        return $this->error;
    }

    /**
     * Set true if an error occured
     *
     * @param boolean $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Get the controller name for the error
     *
     * @return string
     */
    public function getErrorControllerName()
    {
        return $this->errorControllerName;
    }

    /**
     * Set the controller name for the error
     *
     * @param string $errorControllerName
     */
    public function setErrorControllerName($errorControllerName)
    {
        $this->errorControllerName = $errorControllerName;
    }


}