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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsResponsesTrait;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 23: Choice - Multiple Answers (Selectbox)
 */
class ChoiceMultipleAnswersSelectbox extends AbstractChoice
{
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
        'requiredChecked' => 'item.error.optionsRequired.select.multiple',
        'responsesCheckedMaximum' => 'item.error.optionsResponsesMaximum',
        'responsesCheckedMinimum' => 'item.error.optionsResponsesMinimum',
        'responsesCheckedRange' => 'item.error.optionsResponsesRange',

    ];

    /**
     * The height of the selectbox
     *
     * @var int
     */
    protected $selectboxHeight;

    /**
     * Get the height of the selectbox
     *
     * @return int
     */
    public function getSelectboxHeight()
    {
        return $this->selectboxHeight;
    }

    /**
     * Set the height of the selectbox
     *
     * @param int $selectboxHeight The height
     */
    public function setSelectboxHeight($selectboxHeight)
    {
        $this->selectboxHeight = (int)$selectboxHeight;
    }

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

                    // Check if option is available in the option row
                    if ($optionRow->hasOption($optionUid)) {

                        // Get the option
                        $option = $optionRow->getOption($optionUid);

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