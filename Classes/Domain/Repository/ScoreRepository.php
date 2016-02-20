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

use PatrickBroens\Pbsurvey\Domain\Model\Score;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Score repository
 */
class ScoreRepository extends AbstractRepository
{
    /**
     * @param int $contentElementUid The uid of the survey content element
     * @return Score[]
     */
    public function findByContentElement($contentElementUid)
    {
        $scores = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                page,
                score
            ',
            'tx_pbsurvey_score',
            '
                parentid = ' . (int)$contentElementUid . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'score ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $scores;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $scores[] = $this->setScoreFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $scores;
    }

    /**
     * Set a score from a database record
     *
     * @param array $record The database record
     * @return Score The score
     */
    protected function setScoreFromRecord($record)
    {
        $option = GeneralUtility::makeInstance(Score::class);
        $option->populate($record);

        return $option;
    }
}