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
 * Value default text trait
 */
trait ValueDefaultTextTrait
{
    /**
     * The default value
     *
     * @var string
     */
    protected $valueDefaultText;

    /**
     * Get the default value
     *
     * @return string
     */
    public function getValueDefaultText()
    {
        return $this->valueDefaultText;
    }

    /**
     * Set the default value
     *
     * @param string $valueDefaultText The value
     */
    public function setValueDefaultText($valueDefaultText)
    {
        $this->valueDefaultText = (string)$valueDefaultText;
    }
}