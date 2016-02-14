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
 * Negative first trait
 */
trait NegativeFirst
{
    /**
     * Negative value (false/no) first in order
     *
     * @var bool
     */
    protected $negativeFirst;

    /**
     * Check if the negative option should be displayed first
     *
     * @return bool
     */
    public function isNegativeFirst()
    {
        return $this->negativeFirst;
    }

    /**
     * Check if the positive option should be displayed first
     *
     * @return bool
     */
    public function isPositiveFirst()
    {
        return !$this->negativeFirst;
    }

    /**
     * Set if negative value is first in order
     *
     * @param bool $negativeFirst true if negative value is first
     */
    public function setNegativeFirst($negativeFirst)
    {
        $this->negativeFirst = (bool)$negativeFirst;
    }
}