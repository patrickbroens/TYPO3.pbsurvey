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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Answer repository
 */
class AnswerRepository extends AbstractRepository
{
    /**
     * Find answer by parent id
     *
     * @param int $parentId The result uid
     * @return Answer[]
     */
    public function findByParentId($parentId = 0)
    {
        $answers = [];

        $databaseResource = $this->getDatabaseConnection()->exec_SELECTquery(
            '
                uid,
                item,
                item_option,
                item_option_row,
                open
            ',
            'tx_pbsurvey_answer',
            '
                parent_id = ' . (int)$parentId . '
                AND hidden = 0
                AND deleted = 0
            ',
            '',
            'sorting ASC'
        );

        if ($this->getDatabaseConnection()->sql_error()) {
            $this->getDatabaseConnection()->sql_free_result($databaseResource);
            return $answers;
        }

        while ($record = $this->getDatabaseConnection()->sql_fetch_assoc($databaseResource)) {
            $answers[] = $this->setAnswerFromRecord($record);
        }

        $this->getDatabaseConnection()->sql_free_result($databaseResource);

        return $answers;
    }

    /**
     * Set an answer from a database record
     *
     * @param array $record The database record
     * @return Answer The answer
     */
    protected function setAnswerFromRecord($record)
    {
        /** @var Answer $answer */
        $answer = GeneralUtility::makeInstance(Answer::class);
        $answer->populate($record);

        return $answer;
    }
}