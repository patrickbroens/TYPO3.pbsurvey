<?php
namespace PatrickBroens\Pbsurvey\Domain\Repository;

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

use PatrickBroens\Pbsurvey\Domain\Model\FrontendUser;
use PatrickBroens\Pbsurvey\Domain\Model\Result;
use PatrickBroens\Pbsurvey\Domain\Model\Stage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Result repository
 */
class ResultRepository extends AbstractRepository
{
    /**
     * Count the results in the storage folder of a survey
     *
     * @param int $storageFolderUid The uid of the storage folder
     * @return int
     */
    public function countByStorageFolder($storageFolderUid)
    {
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND finished = 1
                AND hidden = 0
                AND deleted = 0
            '
        );

        return (int)$count;
    }

    /**
     * Count the finished surveys by a frontend user
     *
     * @param FrontendUser $frontendUser The frontend user
     * @param int $storageFolderUid The storage folder
     * @return int
     */
    public function countFinishedByFrontendUser(FrontendUser $frontendUser, $storageFolderUid)
    {
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND fe_user = ' . (int)$frontendUser->getUid() . '
                AND finished = 1
                AND hidden = 0
                AND deleted = 0
            '
        );

        return (int)$count;
    }

    /**
     * Count all results by a frontend user
     *
     * @param FrontendUser $frontendUser The frontend user
     * @param int $storageFolderUid The storage folder
     * @return int
     */
    public function countByFrontendUser(FrontendUser $frontendUser, $storageFolderUid)
    {
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND fe_user = ' . (int)$frontendUser->getUid() . '
                AND hidden = 0
                AND deleted = 0
            '
        );

        return (int)$count;
    }

    /**
     * Count the finished surveys by an IP address
     *
     * @param string $ipAddress The IP Address
     * @param int $storageFolderUid The storage folder
     * @return int
     */
    public function countFinishedByIp($ipAddress, $storageFolderUid)
    {
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND ip = ' . $this->getDatabaseConnection()->quoteStr((string)$ipAddress, 'tx_pbsurvey_result') . '
                AND finished = 1
                AND hidden = 0
                AND deleted = 0
            '
        );

        return (int)$count;
    }

    /**
     * Count all results by an IP address
     *
     * @param string $ipAddress The IP Address
     * @param int $storageFolderUid The storage folder
     * @return int
     */
    public function countByIp($ipAddress, $storageFolderUid)
    {
        $count = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND ip = ' . $this->getDatabaseConnection()->quoteStr((string)$ipAddress, 'tx_pbsurvey_result') . '
                AND hidden = 0
                AND deleted = 0
            '
        );

        return (int)$count;
    }

    /**
     * Find result by uid
     *
     * @param int $resultUid The result uid
     * @return Result
     */
    public function findByUid($resultUid = 0)
    {
        $result = null;

        $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            '
                uid,
                answers,
                fe_user,
                finished,
                ip,
                language_uid,
                timestamp_begin,
                timestamp_end
            ',
            'tx_pbsurvey_result',
            '
                uid = ' . (int)$resultUid . '
                AND hidden = 0
                AND deleted = 0
            '
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            return $result;
        }

        if ($record) {
            $result = $this->setResultFromRecord($record);
        }

        return $result;
    }

    /**
     * Find the latest result by ip address
     *
     * @param string $ipAddress The IP address
     * @param int $storageFolderUid The storage folder
     * @return null|Result
     */
    public function findLatestByIp($ipAddress, $storageFolderUid)
    {
        $result = null;

        $record = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            '
                uid,
                answers,
                fe_user,
                finished,
                ip,
                language_uid,
                timestamp_begin,
                timestamp_end
            ',
            'tx_pbsurvey_result',
            '
                pid = ' .(int)$storageFolderUid . '
                AND ip = ' . $this->getDatabaseConnection()->quoteStr((string)$ipAddress, 'tx_pbsurvey_result') . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'timestamp_begin DESC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            return $result;
        }

        if ($record) {
            $result = $this->setResultFromRecord($record);
        }

        return $result;
    }

    /**
     * Set a result from a database record
     *
     * @param array $record The database record
     * @return Result The result
     */
    protected function setResultFromRecord($record)
    {
        /** @var Result $result */
        $result = GeneralUtility::makeInstance(Result::class);
        $result->populate($record);

        $result->addStages($this->getStages($result));

        return $result;
    }

    /**
     * Get the stages
     *
     * @param Result $result The result
     * @return Stage[] The stages
     */
    protected function getStages($result) {
        $stageRepository = GeneralUtility::makeInstance(StageRepository::class);
        return $stageRepository->findByParentId($result->getUid());
    }
}