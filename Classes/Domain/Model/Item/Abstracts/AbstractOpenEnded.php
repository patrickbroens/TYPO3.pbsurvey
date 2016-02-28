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

/**
 * Open ended question abstract
 */
abstract class AbstractOpenEnded extends AbstractQuestion
{
    /**
     * Open ended question
     *
     * @var bool
     */
    protected static $openEnded = true;

    /**
     * The answer
     *
     * @var Answer
     */
    protected $answer;

    /**
     * Check if the answer exists
     *
     * @return bool
     */
    public function hasAnswer()
    {
        return !empty($this->answer);
    }

    /**
     * Get the answer
     *
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set the answer
     *
     * @param Answer $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = (string)$answer->getOpen();
    }

    /**
     * Set the answers
     *
     * @param Answer[] $answers
     */
    public function setAnswers(array $answers)
    {
        $this->setAnswer(reset($answers));
    }
}