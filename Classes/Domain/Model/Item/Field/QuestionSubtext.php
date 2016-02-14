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
 * Question subtext trait
 */
trait QuestionSubtext
{
    /**
     * The question subtext
     *
     * @var string
     */
    protected $questionSubtext;

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
}