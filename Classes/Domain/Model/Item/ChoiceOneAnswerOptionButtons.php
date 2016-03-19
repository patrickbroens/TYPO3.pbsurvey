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

use PatrickBroens\Pbsurvey\Domain\Model\Answer;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\AnswersAdditionalTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsAlignmentTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 3: Choice - One Answer (Option Buttons)
 */
class ChoiceOneAnswerOptionButtons extends AbstractChoice
{
    /**
     * TRAIT: AnswersAdditionalTrait
     *
     * FIELDS:
     * $answersAdditionalAllow
     * $answersAdditionalText
     * $answersAdditionalType
     * $textareaHeight
     * $textareaWidth
     */
    use AnswersAdditionalTrait;

    /**
     * TRAIT: OptionsAlignmentTrait
     *
     * FIELDS:
     * $optionsAlignment
     */
    use OptionsAlignmentTrait;

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
        'requiredChecked' => 'item.error.optionsRequired.select.single',
        'additionalValue' => 'item.error.additional'
    ];

    /**
     * Initialize this item
     *
     * Make the item 2 dimensional
     */
    public function initialize()
    {
        $this->optionRows = [];

        if ($this->getAnswersAdditionalAllow()) {
            /** @var Option $additionalOption */
            $additionalOption = GeneralUtility::makeInstance(Option::class);
            $additionalOption->setUid(-1);

            $this->addOption($additionalOption);
        }

        /** @var OptionRow $optionRow */
        $optionRow = GeneralUtility::makeInstance(OptionRow::class);
        $optionRow->setUid(0);

        $optionRow->addOptions($this->getOptions());

        $this->addOptionRow($optionRow);
    }

    /**
     * Set the answers from the request data
     *
     * Checks if option rows and options are available.
     * If so, fills the values in the options
     * Secondly it will construct an answer for storage
     *
     * @param array $answers The answers from the request data
     * @return Answer[] The answers for storage
     */
    public function convertRequestDataToAnswers(array $answers)
    {
        // Iterate the answers for this item
        foreach ($answers as $optionRowUid => $field) {
            $optionRowUid = (int)$optionRowUid;

            // Check if option row is available and we got an array as input
            if (
                $this->hasOptionRow($optionRowUid)
                && is_array($field)
                && isset($field['o'])
            ) {
                $optionUid = (int)$field['o'];

                // Get the option row
                $optionRow = $this->getOptionRow($optionRowUid);

                if ($optionRow->hasOption($optionUid)) {

                    // Get the option
                    $option = $optionRow->getOption($optionUid);

                    // Did we get an additional answer and is this allowed?
                    if (
                        $optionUid === -1
                        && $this->getAnswersAdditionalAllow()
                        && isset($field['a'])
                        && is_string($field['a'])
                    ) {
                        $value = $field['a'];

                        $option->setChecked(true);
                        $option->setValue($value);

                        $this->setAnswer(
                            $optionRowUid,
                            $optionUid,
                            $value
                        );

                    // Regular option
                    } else {
                        $option->setChecked(true);

                        $this->setAnswer(
                            $optionRowUid,
                            $optionUid
                        );
                    }
                }
            }
        }

        return $this->getAnswers();
    }
}