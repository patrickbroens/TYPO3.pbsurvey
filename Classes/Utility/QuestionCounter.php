<?php
namespace PatrickBroens\Pbsurvey\Utility;

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

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Question counter
 */
class QuestionCounter implements SingletonInterface
{
    /**
     * The counter
     *
     * @var int
     */
    protected $counter = 1;

    /**
     * Get the counter and raise it with one
     *
     * @return int
     */
    public function getAndRaise()
    {
        $counter = $this->counter;

        $this->counter++;

        return $counter;
    }
}