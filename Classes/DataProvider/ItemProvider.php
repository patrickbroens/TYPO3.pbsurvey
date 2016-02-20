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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item provider
 */
class ItemProvider
{
    /**
     * The items
     *
     * @var AbstractItem[]
     */
    protected $items = [];

    /**
     * Add an item
     *
     * @param AbstractItem $item The item
     */
    public function addSingle(AbstractItem $item)
    {
        $this->items[$item->getUid()] = $item;
    }

    /**
     * Find an item by its uid
     *
     * @param int $uid
     * @return null|AbstractItem
     */
    public function findByUid($uid)
    {
        $item = null;

        if (isset($this->items[$uid])) {
            $item = $this->items[$uid];
        }

        return $item;
    }

    /**
     * Get the amount of items
     *
     * @return int
     */
    public function getCount()
    {
        return count($this->items);
    }
}