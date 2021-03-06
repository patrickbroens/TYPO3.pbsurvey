<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Field;

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
 * Maximum length trait
 */
trait LengthMaximum
{
    /**
     * The maximum length
     *
     * @var int
     */
    protected $lengthMaximum;

    /**
     * Get the maximum length
     *
     * @return int
     */
    public function getLengthMaximum()
    {
        return $this->lengthMaximum;
    }

    /**
     * Set the maximum length
     *
     * @param int $lengthMaximum The value
     */
    public function setLangthMaximum($lengthMaximum)
    {
        $this->lengthMaximum = (int)$lengthMaximum;
    }
}