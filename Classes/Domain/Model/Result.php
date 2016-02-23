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

use PatrickBroens\Pbsurvey\Domain\Model\Answer;

/**
 * Result
 */
class Result extends AbstractModel
{
    /**
     * The answers of this result
     *
     * @var Answer[]
     */
    protected $answers;

    /**
     * The frontend user
     *
     * @var FrontendUser
     */
    protected $feUser;

    /**
     * True when respondent finished the survey
     *
     * @var bool
     */
    protected $finished;

    /**
     * The IP address of the respondent
     *
     * @var string
     */
    protected $ip;

    /**
     * The language
     *
     * @var int
     */
    protected $languageUid;

    /**
     * The timestamp when the respondent started with the survey
     *
     * @var int
     */
    protected $timestampBegin;

    /**
     * The timestamp when the respondent finished the survey
     *
     * @var int
     */
    protected $timestampEnd;

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
     * Get the frontend user
     *
     * @return FrontendUser
     */
    public function getFeUser()
    {
        return $this->feUser;
    }

    /**
     * Set the frontend user
     *
     * @param FrontendUser $feUser The frontend user
     */
    public function setFeUser(FrontendUser $feUser)
    {
        $this->feUser = $feUser;
    }

    /**
     * Has the respondent finished the survey
     *
     * @return bool
     */
    public function isFinished()
    {
        return $this->finished;
    }

    /**
     * Set if the respondent finished the survey
     *
     * @param boolean $finished true when finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * Get the IP address
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set the IP address
     *
     * @param string $ip The IP address
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get the language id
     *
     * @return int
     */
    public function getLanguageUid()
    {
        return $this->languageUid;
    }

    /**
     * Set the language id
     *
     * @param int $languageUid The uid
     */
    public function setLanguageUid($languageUid)
    {
        $this->languageUid = $languageUid;
    }

    /**
     * Get the timestamp when the respondent started the survey
     *
     * @return int
     */
    public function getTimestampBegin()
    {
        return $this->timestampBegin;
    }

    /**
     * Set the timestamp when the respondent started the survey
     *
     * @param int $timestampBegin The timestamp
     */
    public function setTimestampBegin($timestampBegin)
    {
        $this->timestampBegin = $timestampBegin;
    }

    /**
     * Get the timestamp when the respondent finished the survey
     *
     * @return int
     */
    public function getTimestampEnd()
    {
        return $this->timestampEnd;
    }

    /**
     * Set the timestamp when the respondent finished the survey
     *
     * @param int $timestampEnd The timestamp
     */
    public function setTimestampEnd($timestampEnd)
    {
        $this->timestampEnd = $timestampEnd;
    }
}