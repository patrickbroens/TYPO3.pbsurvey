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
 * Options random trait
 */
trait OptionsRandomTrait
{
    /**
     * Should the options be displayed in random order
     *
     * @var bool
     */
    protected $optionsRandom;

    /**
     * Check if the options should be displayed in random order
     *
     * @return bool
     */
    public function isRandom()
    {
        return $this->optionsRandom;
    }

    /**
     * Set if the options should be displayed in random order
     *
     * @param bool $optionsRandom true if options should be displayed in random order
     */
    public function setOptionsRandom($optionsRandom)
    {
        $this->optionsRandom = (bool)$optionsRandom;
    }
}