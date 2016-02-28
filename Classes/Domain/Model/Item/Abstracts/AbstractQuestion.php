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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Interfaces\QuestionInterface;

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
            in_array('provision', $allowedConditionOperatorGroups)
            && $this->getOptionsRequired()
        ) {
            $provisionKey = array_search('provision', $allowedConditionOperatorGroups);
            unset($allowedConditionOperatorGroups[$provisionKey]);
        }

        return $allowedConditionOperatorGroups;
    }
}