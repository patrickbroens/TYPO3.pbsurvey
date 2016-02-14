<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Field;

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

/**
 * Question trait
 */
trait Question
{
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
}