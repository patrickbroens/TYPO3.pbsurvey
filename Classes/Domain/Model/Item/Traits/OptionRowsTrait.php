<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Traits;

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

use \PatrickBroens\Pbsurvey\Domain\Model\OptionRow;

/**
 * Option rows trait
 */
trait OptionRowsTrait
{
    /**
     * The option rows
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\OptionRow[]
     */
    protected $optionRows;

    /**
     * Check if option row exists
     *
     * @param int $optionRowUid The option row uid
     * @return bool true if option row exists
     */
    public function hasOptionRow($optionRowUid)
    {
        return isset($this->optionRows[$optionRowUid]);
    }

    /**
     * Check if the item contains option rows
     *
     * @return bool true when option rows are available
     */
    public function hasOptionRows()
    {
        return !empty($this->optionRows);
    }

    /**
     * Get an option row by its uid
     *
     * @param int $optionRowUid The option row uid
     * @return null|\PatrickBroens\Pbsurvey\Domain\Model\OptionRow The option row
     */
    public function getOptionRow($optionRowUid)
    {
        $optionRow = null;

        if ($this->hasOptionRow($optionRowUid)) {
            $optionRow = $this->optionRows[$optionRowUid];
        }

        return $optionRow;
    }

    /**
     * Get the option rows
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionRow[]
     */
    public function getOptionRows()
    {
        return $this->optionRows;
    }

    /**
     * Add an option row
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionRow $optionRow The option row
     */
    public function addOptionRow(OptionRow $optionRow)
    {
        $this->optionRows[$optionRow->getUid()] = $optionRow;
    }

    /**
     * Add option rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionRow[] $optionRows The option rows
     */
    public function addOptionRows(array $optionRows)
    {
        foreach ($optionRows as $optionRow) {
            if ($optionRow instanceof OptionRow) {
                $this->addOptionRow($optionRow);
            }
        }
    }
}