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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractMatrix;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\NumberTrait;

/**
 * Item type 9: Matrix - Rating Scale (Numeric)
 */
class ItemType9 extends AbstractMatrix
{
    /**
     * TRAIT: NumberTrait
     *
     * FIELDS:
     * $numberEnd
     * $numberStart
     */
    use NumberTrait;

    /**
     * Check if option exists
     *
     * @param int $optionUid The option uid
     * @return bool true if option exists
     */
    public function hasOption($optionUid)
    {
        return in_array($optionUid, range($this->numberStart, $this->numberEnd));
    }

    /**
     * Check if the item contains options (answers)
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return $this->numberStart !== $this->numberEnd;
    }

    /**
     * Get an option by its uid
     *
     * @param int $optionUid The option uid
     * @return null|\PatrickBroens\Pbsurvey\Domain\Model\Option The option
     */
    public function getOption($optionUid)
    {
        $option = null;

        if ($this->hasOption($optionUid)) {
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionUid);
            $option->setValue($optionUid);
        }

        return $option;
    }

    /**
     * Get the options
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    public function getOptions()
    {
        $options = [];

        if ($this->hasOptions()) {
            foreach (range($this->numberStart, $this->numberEnd) as $number) {
                $options[] = $this->getOption($number);
            }
        }

        return $options;
    }
}