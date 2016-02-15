<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Field;

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
trait OptionRows
{
    /**
     * The option rows
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\OptionRow[]
     */
    protected $optionRows;

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
        $this->optionRows[] = $optionRow;
    }

    /**
     * Add option rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionRow[] $optionRows The option rows
     */
    public function addOptionRows(array $optionRows)
    {
        foreach ($optionRows as $optionRow) {
            if ($row instanceof \PatrickBroens\Pbsurvey\Domain\Model\OptionRow) {
                $this->addOptionRow($optionRow);
            }
        }
    }
}