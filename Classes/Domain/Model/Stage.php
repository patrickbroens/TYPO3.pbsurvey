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
use PatrickBroens\Pbsurvey\Utility\ArrayUtility;

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
    protected $answers = [];

    /**
     * The page
     *
     * @var Page
     */
    protected $page;

    /**
     * The sorting order
     *
     * This value is equal to the stage number
     *
     * @var int
     */
    protected $sorting;


    /**
     * Check if there are answers for a certain item
     *
     * @param int $itemUid The item uid
     * @return bool
     */
    public function hasAnswersByItemUid($itemUid)
    {
        return !empty($this->getAnswersByItemUid($itemUid));
    }

    /**
     * Get answers for a certain item
     *
     * @param int $itemUid The item uid
     * @return array
     */
    public function getAnswersByItemUid($itemUid)
    {
        return ArrayUtility::findObjectByPropertyValue($this->answers, 'item', $itemUid);
    }

    /**
     * Check if there are answers
     *
     * @return bool
     */
    public function hasAnswers()
    {
        return !empty($this->answers);
    }

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
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the page
     *
     * @param int $page The page
     */
    public function setPage($page)
    {
        $this->page = (int)$page;
    }

    /**
     * Get the number of the stage
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->sorting;
    }

    /**
     * Set the number of the stage
     *
     * @param int $number The number
     */
    public function setNumber($number)
    {
        $this->sorting = (int)$number;
    }
}