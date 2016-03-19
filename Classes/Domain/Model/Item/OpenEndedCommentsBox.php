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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractOpenEnded;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\ValueDefaultTextTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 10: Open Ended - Comments Box
 */
class OpenEndedCommentsBox extends AbstractOpenEnded
{
    /**
     * TRAIT: ValueDefaultTextTrait
     *
     * FIELDS:
     * $valueDefaultText
     */
    use ValueDefaultTextTrait;

    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'containment',
        'provision'
    ];

    /**
     * The validators to be used
     *
     * @var array
     */
    protected static $validators = [
        'requiredValue' => 'item.error.optionsRequired.enter'
    ];

    /**
     * Initialize this item
     *
     * Make the item 2 dimensional
     */
    public function initialize()
    {
        $this->options = $this->optionRows = [];

        /** @var Option $option */
        $option = GeneralUtility::makeInstance(Option::class);
        $option->setUid(0);

        if ($this->valueDefaultText) {
            $option->setChecked(true);
            $option->setValue($this->getValueDefaultText());
        }

        /** @var OptionRow $optionRow */
        $optionRow = GeneralUtility::makeInstance(OptionRow::class);
        $optionRow->setUid(0);
        $optionRow->addOption($option);

        $this->addOptionRow($optionRow);
    }
}