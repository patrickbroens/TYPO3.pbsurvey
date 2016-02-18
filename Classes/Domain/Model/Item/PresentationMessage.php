<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item;

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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractPresentation;

/**
 * Item type 21: Presentation - Message
 */
class PresentationMessage extends AbstractPresentation
{
    /**
     * The message
     *
     * @var string
     */
    protected $message;

    /**
     * Get the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the message
     *
     * @param string $message The message
     */
    public function setMessage($message)
    {
        $this->message = (string)$message;
    }
}