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
 * Number total trait
 */
trait NumberTotalTrait
{
    /**
     * Answer total
     *
     * @var int
     */
    protected $numberTotal;

    /**
     * Get the total number
     *
     * @return int
     */
    public function getNumberTotal()
    {
        return $this->numberTotal;
    }

    /**
     * Set the total number
     *
     * @param int $numberTotal The total number
     */
    public function setNumberTotal($numberTotal)
    {
        $this->numberTotal = (int)$numberTotal;
    }
}