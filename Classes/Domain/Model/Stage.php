<?php
namespace PatrickBroens\Pbsurvey\Domain\Model;

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
 * Stage
 */
class Stage extends AbstractModel
{
    /**
     * The answers of this result
     *
     * @var Answer[]
     */
    protected $answers;

    /**
     * The page
     *
     * @var Page
     */
    protected $page;

    /**
     * Get the answers
     *
     * @return Answer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add an answer
     *
     * @param Answer $answer The answer
     */
    public function addAnswer(Answer $answer)
    {
        $this->answers[$answer->getUid()] = $answer;
    }

    /**
     * Set the answers
     *
     * @param Answer[] $answers The answers
     */
    public function addAnswers(array $answers)
    {
        foreach ($answers as $answer) {
            if ($answer instanceof Answer) {
                $this->addAnswer($answer);
            }
        }
    }

    /**
     * Get the page
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the page
     *
     * @param Page $page The page
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
    }
}