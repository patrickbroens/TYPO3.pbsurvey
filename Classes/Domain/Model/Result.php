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
use PatrickBroens\Pbsurvey\Domain\Repository\StageRepository;
use PatrickBroens\Pbsurvey\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Result
 */
class Result extends AbstractModel
{
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
     * The stages of this result
     *
     * @var Stage[]
     */
    protected $stages;

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
     * Get a stage
     *
     * @param int $stageUid The stage uid
     * @return null|Stage
     */
    public function getStage($stageUid)
    {
        $stage = null;

        if (isset($this->stages[$stageUid])) {
            $stage = $this->stages[$stageUid];
        }

        return $stage;
    }

    /**
     * Get a stage by its number
     *
     * @param int $number The number
     * @return null|Stage
     */
    public function getStageByNumber($number)
    {
        return $this->getStage(ArrayUtility::findKeyByPosition($this->stages, $number));
    }

    /**
     * Get the previous stage
     *
     * @param int $number The number
     * @return null|Stage
     */
    public function getPreviousStage($number)
    {
        $output = null;

        reset($this->stages);
        while ($stage = current($this->stages)) {
            if ($stage->getNumber() === $number) {
                $output = prev($this->stages);
                break;
            }
        }

        return $output;
    }

    /**
     * Get the stages
     *
     * @return Stage[]
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * Add a stage
     *
     * @param Stage $stage The stage
     */
    public function addStage(Stage $stage)
    {
        $this->stages[$stage->getUid()] = $stage;
    }

    /**
     * Set the stages
     *
     * @param Stage[] $stages The stage
     */
    public function addStages(array $stages)
    {
        foreach ($stages as $stage) {
            if ($stage instanceof Stage) {
                $this->addStage($stage);
            }
        }
    }

    /**
     * Delete a stage and up
     *
     * @param int $stageNumber The stage number to search for
     */
    public function deleteStageAndUp($stageNumber)
    {
        $parentId = $this->getUid();

        $stageRepository = GeneralUtility::makeInstance(StageRepository::class);
        $stageRepository->deleteBySortingAndUp($parentId, $stageNumber);

        foreach ($this->stages as $stage) {
            if ($stage->getNumber() >= $stageNumber) {
                unset($this->stages[$stage->getUid()]);
            }
        }
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