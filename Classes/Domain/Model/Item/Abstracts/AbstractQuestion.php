<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts;

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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Interfaces\QuestionInterface;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Question abstract
 */
abstract class AbstractQuestion extends AbstractStyle implements QuestionInterface
{
    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [];

    /**
     * The validators to be used
     *
     * @var array
     */
    protected static $validators = [];

    /**
     * The answers
     *
     * @var Answer[]
     */
    protected $answers = [];

    /**
     * The errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * The options
     *
     * @var Option[]
     */
    protected $options;

    /**
     * The option rows
     *
     * @var OptionRow[]
     */
    protected $optionRows;

    /**
     * Is the question mandatory
     *
     * @var bool
     */
    protected $optionsRequired;

    /**
     * The question
     *
     * @var string
     */
    protected $question;

    /**
     * The alias of the question
     *
     * @var string
     */
    protected $questionAlias;

    /**
     * The question number
     *
     * @var int
     */
    protected $questionNumber;

    /**
     * The question subtext
     *
     * @var string
     */
    protected $questionSubtext;

    /**
     * Set an answer
     *
     * @param int $optionRowUid The option row uid
     * @param int $optionUid The option uid
     * @param string $value Open answer
     */
    protected function setAnswer($optionRowUid, $optionUid, $value = null)
    {
        /** @var Answer $answer */
        $answer = GeneralUtility::makeInstance(Answer::class);
        $answer->setItem($this->getUid());
        $answer->setItemOptionRow($optionRowUid);
        $answer->setItemOption($optionUid);

        if ($value !== null) {
            $answer->setOpen($value);
        }

        $this->answers[] = $answer;
    }

    /**
     * Set the answers
     *
     * @param Answer[] $answers The answers
     */
    public function setAnswers(array $answers)
    {
        $this->answers = $answers;
    }

    /**
     * Merge the answers into the options
     */
    public function mergeAnswers()
    {
        foreach ($this->optionRows as $optionRow) {
            $optionRow->resetOptions();
        }

        if (0 !== count($this->answers)) {
            foreach ($this->answers as $answer) {
                $optionRow = $this->getOptionRow($answer->getItemOptionRow());
                $option = $optionRow->getOption($answer->getItemOption());
                $option->setChecked(true);
                $option->setValue($answer->getOpen());
            }
        }
    }

    /**
     * Get the answers from the request data
     *
     * @return Answer[]
     */
    protected function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add an error
     *
     * @param string $error The error message
     */
    public function addError($error)
    {
        $this->errors[] = (string)$error;
    }

    /**
     * Get the error messages
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Check if option exists
     *
     * @param int $optionUid The option uid
     * @return bool true if option exists
     */
    public function hasOption($optionUid)
    {
        return isset($this->options[$optionUid]);
    }

    /**
     * Check if the item contains options (answers)
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return 0 !== count($this->options);
    }

    /**
     * Get an option by its uid
     *
     * @param int $optionUid The option uid
     * @return null|Option The option
     */
    public function getOption($optionUid)
    {
        $option = null;

        if ($this->hasOption($optionUid)) {
            $option = $this->options[$optionUid];
        }

        return $option;
    }

    /**
     * Get the options
     *
     * @return Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add an option
     *
     * @param Option $option The option
     */
    public function addOption(Option $option)
    {
        $this->options[$option->getUid()] = $option;
    }

    /**
     * Add options
     *
     * @param Option[] $options The options
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            if ($option instanceof Option) {
                $this->addOption($option);
            }
        }
    }

    /**
     * Check if option row exists
     *
     * @param int $optionRowUid The option row uid
     * @return bool true if option row exists
     */
    public function hasOptionRow($optionRowUid)
    {
        return isset($this->optionRows[$optionRowUid]);
    }

    /**
     * Check if the item contains option rows
     *
     * @return bool true when option rows are available
     */
    public function hasOptionRows()
    {
        return 0 !== count($this->optionRows);
    }

    /**
     * Get an option row by its uid
     *
     * @param int $optionRowUid The option row uid
     * @return null|OptionRow The option row
     */
    public function getOptionRow($optionRowUid)
    {
        $optionRow = null;

        if ($this->hasOptionRow($optionRowUid)) {
            $optionRow = $this->optionRows[$optionRowUid];
        }

        return $optionRow;
    }

    /**
     * Get the option rows
     *
     * @return OptionRow[]
     */
    public function getOptionRows()
    {
        return $this->optionRows;
    }

    /**
     * Add an option row
     *
     * @param OptionRow $optionRow The option row
     */
    public function addOptionRow(OptionRow $optionRow)
    {
        $this->optionRows[$optionRow->getUid()] = $optionRow;
    }

    /**
     * Add option rows
     *
     * @param OptionRow[] $optionRows The option rows
     */
    public function addOptionRows(array $optionRows)
    {
        foreach ($optionRows as $optionRow) {
            if ($optionRow instanceof OptionRow) {
                $this->addOptionRow($optionRow);
            }
        }
    }

    /**
     * Check if the question is mandatory
     *
     * @return bool
     */
    public function getOptionsRequired()
    {
        return $this->optionsRequired;
    }

    /**
     * Set if the question is mandatory
     *
     * @param bool $optionsRequired true if mandatory
     */
    public function setOptionsRequired($optionsRequired)
    {
        $this->optionsRequired = (bool)$optionsRequired;
    }

    /**
     * Get the question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the question
     *
     * @param string $question The question
     */
    public function setQuestion($question)
    {
        $this->question = (string)$question;
    }

    /**
     * Get the question alias
     *
     * @return string
     */
    public function getQuestionAlias()
    {
        return $this->questionAlias;
    }

    /**
     * Set the question alias
     *
     * @param string $questionAlias The question alias
     */
    public function setQuestionAlias($questionAlias)
    {
        $this->questionAlias = (string)$questionAlias;
    }

    /**
     * Get the question number
     *
     * @return int
     */
    public function getQuestionNumber()
    {
        return $this->questionNumber;
    }

    /**
     * Set the question number
     *
     * @param int $questionNumber The question number
     */
    public function setQuestionNumber($questionNumber)
    {
        $this->questionNumber = (int)$questionNumber;
    }

    /**
     * Get the question subtext
     *
     * @return string
     */
    public function getQuestionSubtext()
    {
        return $this->questionSubtext;
    }

    /**
     * Set the question subtext
     *
     * @param string $questionSubtext The question subtext
     */
    public function setQuestionSubtext($questionSubtext)
    {
        $this->questionSubtext = (string)$questionSubtext;
    }

    /**
     * Check if an additional answer is allowed
     *
     * @return bool
     */
    public function isAdditionalAllowed()
    {
        $hasAdditional = false;

        if (method_exists($this, 'getAnswersAdditionalAllow')) {
            $hasAdditional = $this->getAnswersAdditionalAllow();
        }

        return $hasAdditional;
    }

    /**
     * Get the allowed condition operator groups
     *
     * Removes the group 'provision' when an answer is mandatory
     *
     * @return array
     */
    public function getAllowedConditionOperatorGroups()
    {
        $allowedConditionOperatorGroups = static::$allowedConditionOperatorGroups;

        if (
            in_array('provision', $allowedConditionOperatorGroups, true)
            && $this->getOptionsRequired()
        ) {
            $provisionKey = array_search('provision', $allowedConditionOperatorGroups, true);
            unset($allowedConditionOperatorGroups[$provisionKey]);
        }

        return $allowedConditionOperatorGroups;
    }

    public function needsValidator($validatorName)
    {
        return isset(static::$validators[$validatorName]);
    }

    public function getValidatorConfiguration($validatorName)
    {
        return static::$validators[$validatorName];
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
        foreach ($answers as $optionRowUid => $optionUid) {
            $optionRowUid = (int)$optionRowUid;

            // Check if option row is available and we got a number as input
            if (
                $this->hasOptionRow($optionRowUid)
                && is_numeric($optionUid)
            ) {
                $optionUid = (int)$optionUid;

                // Get the option row
                $optionRow = $this->getOptionRow($optionRowUid);

                // Check if the option is available
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

        return $this->getAnswers();
    }
}