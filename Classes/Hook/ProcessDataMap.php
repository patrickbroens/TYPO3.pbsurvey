<?php
namespace PatrickBroens\Pbsurvey\Hook;

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

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Wizard\AnswerWizard;

/**
 * Class that hooks into DataHandler and listens for updates to records
 */
class ProcessDataMap
{
    /**
     * Hooks into the TYPO3 data handler and watches all record creations and updates.
     * If it detects that the new/updated record belongs to a table configured for pbsurvey,
     * it will do some data transformations
     *
     * @param string $status Status of the current operation, 'new' or 'update'
     * @param string $table The table the record belongs to
     * @param mixed $uid The record's uid, [integer] or [string] (like 'NEW...')
     * @param array $fields The record's data
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler TYPO3 main data handler class
     * @return void
     */
    public function processDatamap_afterDatabaseOperations($status, $table, $uid, &$fields, DataHandler &$dataHandler)
    {
        if (
            $table === 'tx_pbsurvey_item'
            && isset($fields['answers_predefined_group'])
            && (int)$fields['answers_predefined_group'] !== 0
        ) {
            // Get the uid of the record when the current operation is 'new'
            $uid = $status === 'new' ? (int)$dataHandler->substNEWwithIDs[$uid] : (int)$uid;

            $predefinedGroup = (int)$fields['answers_predefined_group'];

            $answerWizard = GeneralUtility::makeInstance(AnswerWizard::class);
            $answerWizard->process($uid, $predefinedGroup);
        }
    }
}