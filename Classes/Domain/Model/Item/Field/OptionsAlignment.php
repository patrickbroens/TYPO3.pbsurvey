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
 * Options alignment trait
 */
trait OptionsAlignment
{
    /**
     * The alignment of the options
     * (true for horizontal, false for vertical)
     *
     * @var bool
     */
    protected $optionsAlignment;

    /**
     * Check if the options should be horizontally aligned
     *
     * @return bool
     */
    public function isHorizontal()
    {
        return $this->optionsAlignment;
    }

    /**
     * Check if the options should be vertically aligned
     *
     * @return bool
     */
    public function isVertical()
    {
        return !$this->optionsAlignment;
    }

    /**
     * Set the alignment of the options
     *
     * @param bool $optionsAlignment true for horizontal
     */
    public function setOptionsAlignment($optionsAlignment)
    {
        $this->optionsAlignment = (bool)$optionsAlignment;
    }
}