<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Traits;

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

/**
 * Email trait
 */
trait EmailTrait
{
    /**
     * The email address
     *
     * @var string
     */
    protected $email;

    /**
     * Get the email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email address
     *
     * @param string $email The email address
     */
    public function setEmail($email)
    {
        $this->email = (string)$email;
    }
}