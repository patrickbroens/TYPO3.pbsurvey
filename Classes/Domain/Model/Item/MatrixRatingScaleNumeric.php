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
class MatrixRatingScaleNumeric extends AbstractMatrix
{
    /**
     * The validators to be used
     *
     * @var array
     */
    protected static $validators = [
        'requiredCheckedRow' => 'item.error.optionsRequired.select.row'
    ];

    /**
     * TRAIT: NumberTrait
     *
     * FIELDS:
     * $numberEnd
     * $numberStart
     */
    use NumberTrait;

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->options = [];

        $range = $this->getRange(count($this->optionRows));

        foreach ($range as $optionUid) {
            /** @var Option $option */
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionUid);
            $option->setLabel($optionUid);

            $this->addOption($option);
        }

        foreach ($this->getOptionRows() as $optionRow) {
            foreach ($this->getOptions() as $option) {
                $optionRow->addOption($option);
            }
        }
    }
}