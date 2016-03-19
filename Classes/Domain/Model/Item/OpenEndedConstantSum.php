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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionRowsTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 11: Open Ended - Constant Sum
 */
class OpenEndedConstantSum extends AbstractChoice
{
    /**
     * TRAIT: OptionsRandomTrait
     *
     * FIELDS:
     * $optionsRandom
     */
    use OptionsRandomTrait;

    /**
     * TRAIT: OptionRowsTrait
     *
     * FIELDS:
     * $optionRows
     */
    use OptionRowsTrait;

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
        'requiredSum' => 'item.error.optionsRequired.number',
        'integer' => 'item.error.number.label',
        'sum' => 'item.error.number.equals'
    ];

    /**
     * Answer total
     *
     * @var int
     */
    protected $numberTotal;

    /**
     * Get the total number
     *
     * @return int
     */
    public function getNumberTotal()
    {
        return $this->numberTotal;
    }

    /**
     * Set the total number
     *
     * @param int $numberTotal The total number
     */
    public function setNumberTotal($numberTotal)
    {
        $this->numberTotal = (int)$numberTotal;
    }

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->options = [];

        foreach ($this->getOptionRows() as $optionRow) {
            /** @var Option $option */
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionRow->getUid());
            $option->setLabel($optionRow->getLabel());

            $optionRow->addOption($option);
        }
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
                        $optionRowUid === $optionUid
                        && $optionRow->hasOption($optionUid)
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