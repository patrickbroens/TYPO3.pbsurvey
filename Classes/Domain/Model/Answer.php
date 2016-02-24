<?php
namespace PatrickBroens\Pbsurvey\Domain\Model;

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
 * Answer
 */
class Answer extends AbstractModel
{
    /**
     * The item
     *
     * @var int
     */
    protected $item;

    /**
     * The item option
     *
     * @var int
     */
    protected $itemOption;

    /**
     * The item option row
     *
     * @var int
     */
    protected $itemOptionRow;

    /**
     * The open answer
     *
     * @var string
     */
    protected $open;

    /**
     * Get the item
     *
     * @return int
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set the item
     *
     * @param int $item The item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * Get the item option
     *
     * @return int
     */
    public function getItemOption()
    {
        return $this->itemOption;
    }

    /**
     * Set the item option
     *
     * @param int $itemOption The item option
     */
    public function setItemOption($itemOption)
    {
        $this->itemOption = $itemOption;
    }

    /**
     * Get the item option row
     *
     * @return int
     */
    public function getItemOptionRow()
    {
        return $this->itemOptionRow;
    }

    /**
     * Set the item option row
     *
     * @param int $itemOptionRow The item option row
     */
    public function setItemOptionRow($itemOptionRow)
    {
        $this->itemOptionRow = $itemOptionRow;
    }

    /**
     * Get the open answer
     *
     * @return string
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Set the open answer
     *
     * @param string $open The open answer
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }
}