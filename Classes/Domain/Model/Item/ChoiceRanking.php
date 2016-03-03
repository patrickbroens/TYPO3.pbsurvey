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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\NumberTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionRowsTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 16: Choice - Ranking
 */
class ChoiceRanking extends AbstractChoice
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
     * TRAIT: OptionRowsTrait
     *
     * FIELDS:
     * $optionRows
     */
    use OptionRowsTrait;

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->options = [];

        $range = $this->getRange(count($this->optionRows), true);

        foreach ($range as $optionUid) {
            /** @var Option $option */
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionUid);
            $option->setValue($optionUid);

            $this->addOption($option);
        }

        /** @var OptionRow $optionRow */
        foreach ($this->optionRows as $optionRow) {
            foreach ($this->options as $option) {
                $optionRow->addOption($option);
            }
        }
    }
}