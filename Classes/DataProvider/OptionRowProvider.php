<?php
namespace PatrickBroens\Pbsurvey\DataProvider;

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

use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Option row provider
 */
class OptionRowProvider
{
    /**
     * The option rows
     *
     * @var OptionRow[]
     */
    protected $optionRows = [];

    /**
     * Add an option row
     *
     * @param OptionRow $optionRow The option row
     */
    public function addSingle(OptionRow $optionRow)
    {
        $this->optionRows[$optionRow->getUid()] = $optionRow;
    }

    /**
     * Get the amount of option rows
     *
     * @return int
     */
    public function getCount()
    {
        return count($this->optionRows);
    }
}