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

use PatrickBroens\Pbsurvey\Domain\Model\Answer;
use PatrickBroens\Pbsurvey\Domain\Model\Stage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Stage repository
 */
class StageRepository extends AbstractRepository
{
    /**
     * @param int $parentId The uid of the result
     * @return Stage[]
     */
    public function findByParentId($parentId)
    {
        $stages = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                page,
                parentid
            ',
            'tx_pbsurvey_stage',
            '
                parentid = ' . (int)$parentId . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $stages;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $stages[] = $this->setStageFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $stages;
    }

    /**
     * Set a stage from a database record
     *
     * @param array $record The database record
     * @return Stage The stage
     */
    protected function setStageFromRecord($record)
    {
        /** @var Stage $stage */
        $stage = GeneralUtility::makeInstance(Stage::class);
        $stage->populate($record);

        $stage->addAnswers($this->getAnswers($stage));

        return $stage;
    }

    /**
     * Get the answers
     *
     * @param Stage $stage The stage
     * @return Answer[] The answers
     */
    protected function getAnswers($stage) {
        $answerRepository = GeneralUtility::makeInstance(AnswerRepository::class);
        return $answerRepository->findByParentId($stage->getUid());
    }
}