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
 * Value numeric trait
 */
trait ValueNumericTrait
{
    /**
     * The default numeric value
     *
     * @var int
     */
    protected $valueDefaultNumeric;

    /**
     * The maximum value
     *
     * @var int
     */
    protected $valueMaximum;

    /**
     * The minimum value
     *
     * @var int
     */
    protected $valueMinimum;

    /**
     * Get the default value
     *
     * @return int
     */
    public function getValueDefaultNumeric()
    {
        return $this->valueDefaultNumeric;
    }

    /**
     * Set the default value
     *
     * @param int $valueDefaultNumeric The value
     */
    public function setValueDefaultNumeric($valueDefaultNumeric)
    {
        $this->valueDefaultNumeric = (int)$valueDefaultNumeric;
    }

    /**
     * Get the maximum value
     *
     * @return int
     */
    public function getValueMaximum()
    {
        return $this->valueMaximum;
    }

    /**
     * Set the maximum value
     *
     * @param int $valueMaximum The value
     */
    public function setValueMaximum($valueMaximum)
    {
        $this->valueMaximum = (int)$valueMaximum;
    }

    /**
     * Get the minimum value
     *
     * @return int
     */
    public function getValueMinimum()
    {
        return $this->valueMinimum;
    }

    /**
     * Set the minimum value
     *
     * @param int $valueMinimum The value
     */
    public function setValueMinimum($valueMinimum)
    {
        $this->valueMinimum = (int)$valueMinimum;
    }
}