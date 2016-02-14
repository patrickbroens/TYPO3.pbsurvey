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

use \PatrickBroens\Pbsurvey\Domain\Model\Option;

/**
 * Answers trait
 */
trait Answers
{
    /**
     * The answers
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    protected $answers;

    /**
     * Get the answers
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add an answer
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Option $answer The answer
     */
    public function addAnswer(Option $answer)
    {
        $this->answers[] = $answer;
    }

    /**
     * Add answers
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Option[] $answers The answers
     */
    public function addAnswers(array $answers)
    {
        foreach ($answers as $answer) {
            if ($answer instanceof \PatrickBroens\Pbsurvey\Domain\Model\Option) {
                $this->addAnswer($answer);
            }
        }
    }
}