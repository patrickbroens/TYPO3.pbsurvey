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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractOpenEnded;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\LengthMaximumTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 13: Open Ended - Number
 */
class OpenEndedNumber extends AbstractOpenEnded
{
    /**
     * TRAIT: LengthMaximumTrait
     *
     * FIELDS:
     * $lengthMaximum
     */
    use LengthMaximumTrait;

    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'containment',
        'mathematical',
        'provision'
    ];

    /**
     * The validators to be used
     *
     * @var array
     */
    protected static $validators = [
        'requiredValue' => 'item.error.number.optionsRequired',
        'integer' => 'item.error.number.label',
        'integerMaximum' => 'item.error.number.maximum',
        'integerMinimum' => 'item.error.number.minimum',
        'integerRange' => 'item.error.number.both',
        'length' => 'item.error.number.length'
    ];

    /**
     * The default numeric value
     *
     * @var int
     */
    protected $valueDefaultNumeric;

    /**
     * The maximum value
     *
     * @var int
     */
    protected $valueMaximum;

    /**
     * The minimum value
     *
     * @var int
     */
    protected $valueMinimum;

    /**
     * Get the default value
     *
     * @return int
     */
    public function getValueDefaultNumeric()
    {
        return $this->valueDefaultNumeric;
    }

    /**
     * Set the default value
     *
     * @param int $valueDefaultNumeric The value
     */
    public function setValueDefaultNumeric($valueDefaultNumeric)
    {
        $this->valueDefaultNumeric = (int)$valueDefaultNumeric;
    }

    /**
     * Get the maximum value
     *
     * @return int
     */
    public function getValueMaximum()
    {
        return $this->valueMaximum;
    }

    /**
     * Set the maximum value
     *
     * @param int $valueMaximum The value
     */
    public function setValueMaximum($valueMaximum)
    {
        $this->valueMaximum = (int)$valueMaximum;
    }

    /**
     * Get the minimum value
     *
     * @return int
     */
    public function getValueMinimum()
    {
        return $this->valueMinimum;
    }

    /**
     * Set the minimum value
     *
     * @param int $valueMinimum The value
     */
    public function setValueMinimum($valueMinimum)
    {
        $this->valueMinimum = (int)$valueMinimum;
    }

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
        $option->setLabel($this->getQuestion());

        if ($this->valueDefaultNumeric) {
            $option->setChecked(true);
            $option->setValue($this->getValueDefaultNumeric());
        }

        /** @var OptionRow $optionRow */
        $optionRow = GeneralUtility::makeInstance(OptionRow::class);
        $optionRow->setUid(0);
        $optionRow->addOption($option);

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
                foreach ($options as $optionUid => $value) {
                    $optionUid = (int)$optionUid;

                    // Check if option is available in the option row
                    if (
                        $optionRow->hasOption($optionUid)
                    ) {

                        // Get the option
                        $option = $optionRow->getOption($optionUid);

                        $option->setChecked(true);
                        $option->setValue($value);

                        $this->setAnswer(
                            $optionRowUid,
                            $optionUid,
                            $value
                        );
                    }
                }
            }
        }

        return $this->getAnswers();
    }
}