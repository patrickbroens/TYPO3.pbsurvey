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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsResponsesTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 1: Choice - Multiple Answers (Checkboxes)
 */
class ChoiceMultipleAnswersCheckboxes extends AbstractChoice
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
     * TRAIT: OptionsResponsesTrait
     *
     * FIELDS:
     * $optionsResponsesMaximum
     * $optionsResponsesMinimum
     */
    use OptionsResponsesTrait;

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
        'additionalValue' => 'item.error.additional',
        'requiredChecked' => 'item.error.optionsRequired.select.multiple',
        'responsesCheckedMaximum' => 'item.error.optionsResponsesMaximum',
        'responsesCheckedMinimum' => 'item.error.optionsResponsesMinimum',
        'responsesCheckedRange' => 'item.error.optionsResponsesRange',

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
        foreach ($answers as $optionRowUid => $options) {
            $optionRowUid = (int)$optionRowUid;

            // Check if option row is available and we got an array as input
            if (
                $this->hasOptionRow($optionRowUid)
                && is_array($options)
            ) {
                // Get the option row
                $optionRow = $this->getOptionRow($optionRowUid);

                // Iterate the options
                foreach ($options as $key => $optionUid) {
                    $key = (int)$key;
                    $optionUid = (int)$optionUid;

                    // Only get the checkboxes (-1 is additional value)
                    // Check if option is available in the option row
                    if (
                        $key >= 0
                        && $optionRow->hasOption($optionUid)
                    ) {
                        // Get the option
                        $option = $optionRow->getOption($optionUid);

                        // Did we get an additional answer and is this allowed?
                        if (
                            $optionUid === -1
                            && $this->getAnswersAdditionalAllow()
                        ) {
                            $option->setChecked(true);
                            $value = '';

                            if (
                                isset($options[-1])
                                && is_string($options[-1])
                            ) {
                                $value = $options[-1];
                                $option->setValue($value);
                            }

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
        }

        return $this->getAnswers();
    }
}