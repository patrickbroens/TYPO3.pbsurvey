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

use \PatrickBroens\Pbsurvey\Domain\Model\Row;

/**
 * Rows trait
 */
trait Rows
{
    /**
     * The rows
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\Row[]
     */
    protected $rows;

    /**
     * Check if the item contains rows
     *
     * @return bool true when rows are available
     */
    public function hasRows()
    {
        return !empty($this->rows);
    }

    /**
     * Get the rows
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Row[]
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Add an row
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Row $row The row
     */
    public function addRow(Row $row)
    {
        $this->row[] = $row;
    }

    /**
     * Add rows
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Row[] $rows The rows
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            if ($row instanceof \PatrickBroens\Pbsurvey\Domain\Model\Row) {
                $this->addRow($row);
            }
        }
    }
}