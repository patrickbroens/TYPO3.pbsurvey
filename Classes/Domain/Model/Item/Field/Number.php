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
 * Number trait
 */
trait Number
{
    /**
     * Ending number
     *
     * @var int
     */
    protected $numberEnd;

    /**
     * Beginning number
     *
     * @var int
     */
    protected $numberStart;

    /**
     * Get the ending number
     *
     * @return int
     */
    public function getNumberEnd()
    {
        return $this->numberEnd;
    }

    /**
     * Set the ending number
     *
     * @param int $numberEnd The ending number
     */
    public function setNumberEnd($numberEnd)
    {
        $this->numberEnd = (int)$numberEnd;
    }

    /**
     * Get the beginning number
     *
     * @return int
     */
    public function getNumberStart()
    {
        return $this->numberStart;
    }

    /**
     * Set the beginning number
     *
     * @param int $numberStart The beginning number
     */
    public function setNumberStart($numberStart)
    {
        $this->numberStart = (int)$numberStart;
    }
}