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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\AnswersNoneTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 2: Choice - One Answer (Dropdown)
 */
class ChoiceOneAnswerDropdown extends AbstractChoice
{
    /**
     * TRAIT: AnswersNoneTrait
     *
     * FIELDS:
     * $anwersNone
     */
    use AnswersNoneTrait;

    /**
     * TRAIT: OptionsRandomTrait
     *
     * FIELDS:
     * $optionsRandom
     */
    use OptionsRandomTrait;

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
        'requiredChecked' => 'item.error.optionsRequired.select.single'
    ];

    /**
     * Initialize this item
     *
     * Make the item 2 dimensional
     */
    public function initialize()
    {
        $this->optionRows = [];

        /** @var OptionRow $optionRow */
        $optionRow = GeneralUtility::makeInstance(OptionRow::class);
        $optionRow->setUid(0);

        $optionRow->addOptions($this->getOptions());

        $this->addOptionRow($optionRow);
    }
}