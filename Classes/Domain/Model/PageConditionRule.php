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
 * Page condition rule
 */
class PageConditionRule extends AbstractModel
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
     * The additional item option
     *
     * @var string
     */
    protected $itemOptionAdditional;

    /**
     * The rule operator
     *
     * @var string
     */
    protected $operator;

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
        $this->item = (int)$item;
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
        $this->itemOption = (int)$itemOption;
    }

    /**
     * Get the additional item option
     *
     * @return string
     */
    public function getItemOptionAdditional()
    {
        return $this->itemOptionAdditional;
    }

    /**
     * Set the additional item option
     *
     * @param string $itemOptionAdditional The additional item option
     */
    public function setItemOptionAdditional($itemOptionAdditional)
    {
        $this->itemOptionAdditional = (string)$itemOptionAdditional;
    }

    /**
     * Get the operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set the operator
     *
     * @param string $operator The operator
     */
    public function setOperator($operator)
    {
        $this->operator = (string)$operator;
    }
}