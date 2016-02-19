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
        return $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tx_pbsurvey_result',
            '
                pid = ' . (int)$storageFolderUid . '
                AND finished = 1
                AND hidden = 0
                AND deleted = 0
            '
        );
    }
}