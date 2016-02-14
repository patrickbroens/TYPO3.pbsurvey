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
 * Answers additional text trait
 */
trait AnswersAdditionalText
{
    /**
     * Allow additional answer
     *
     * @var bool
     */
    protected $answersAdditionalAllow;

    /**
     * The additional answer
     *
     * @var string
     */
    protected $answersAdditionalText;

    /**
     * Display type for the additional answer
     * (false is textbox, true is textarea)
     *
     * @var bool
     */
    protected $answersAdditionalType;

    /**
     * Textarea height
     *
     * @var int
     */
    protected $textareaHeight;

    /**
     * Textarea width
     *
     * @var int
     */
    protected $textareaWidth;

    /**
     * Get if additional answer is allowed
     *
     * @return bool
     */
    public function getAnswersAdditionalAllow()
    {
        return $this->answersAdditionalAllow;
    }

    /**
     * Set if additional answer is allowed
     *
     * @param bool $answersAdditionalAllow
     */
    public function setAnswersAdditionalAllow($answersAdditionalAllow)
    {
        $this->answersAdditionalAllow = (bool)$answersAdditionalAllow;
    }

    /**
     * Get the text for the additional answer
     *
     * @return string
     */
    public function getAnswersAdditionalText()
    {
        return $this->answersAdditionalText;
    }

    /**
     * Set the text for the additional answer
     *
     * @param string $answersAdditionalText The text
     */
    public function setAnswersAdditionalText($answersAdditionalText)
    {
        $this->answersAdditionalText = (string)$answersAdditionalText;
    }

    /**
     * Get the height of the textarea
     *
     * @return int
     */
    public function getTextareaHeight()
    {
        return $this->textareaHeight;
    }

    /**
     * Set the height of the textarea
     *
     * @param int $textareaHeight The height
     */
    public function setTextareaHeight($textareaHeight)
    {
        $this->textareaHeight = (int)$textareaHeight;
    }

    /**
     * Get the width of the textarea
     *
     * @return int
     */
    public function getTextareaWidth()
    {
        return $this->textareaWidth;
    }

    /**
     * Set the width of the textarea
     *
     * @param int $textareaWidth The width
     */
    public function setTextareaWidth($textareaWidth)
    {
        $this->textareaWidth = (int)$textareaWidth;
    }
}