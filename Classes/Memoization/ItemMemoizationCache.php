<?php
namespace PatrickBroens\Pbsurvey\Memoization;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;

/**
 * Item memoization cache
 *
 * For all of you folks who don't know what memoization is:
 * An optimization technique used primarily to speed up computer programs
 * by storing the results of expensive function calls
 * and returning the cached result when the same inputs occur again.
 * @see: https://en.wikipedia.org/wiki/Memoization
 *
 * TCA 'user' type and itemProcFunc sometimes need the same item(s) from the database within runtime
 * so we store it in the memoization cache, or runtime cache.
 */
class ItemMemoizationCache implements SingletonInterface
{
    /**
     * Stored items by uid
     *
     * @var array
     */
    protected $itemsByUid = [];

    /**
     * Stored items by page
     *
     * @var array
     */
    protected $itemsByPage = [];

    /**
     * Check if item is in cache by its uid
     *
     * @param int $itemUid The uid of the survey item
     * @param array $loadObjects The nested models which should be loaded
     * @return bool
     */
    public function hasByUid($itemUid, array $loadObjects)
    {
        $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

        return (
            isset($this->itemsByUid[$itemUid])
            && isset($this->itemsByUid[$itemUid][$objectsIdentifier])
        );
    }

    /**
     * Check if items are in cache by their page
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return bool
     */
    public function hasByPage($pageUid, array $loadObjects)
    {
        $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

        return (
            isset($this->itemsByPage[$pageUid])
            && isset($this->itemsByPage[$pageUid][$objectsIdentifier])
        );
    }

    /**
     * Get an item from the cache by its uid
     *
     * @param int $itemUid The uid of the survey item
     * @param array $loadObjects The nested models which should be loaded
     * @return null|AbstractItem Item when in cache
     */
    public function getByUid($itemUid, array $loadObjects)
    {
        $item = null;

        if ($this->hasByUid($itemUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            $item = $this->itemsByUid[$itemUid][$objectsIdentifier];
        }

        return $item;
    }

    /**
     * Get items from the cache by their survey page
     *
     * @param int $pageUid The uid of the survey page
     * @param array $loadObjects The nested models which should be loaded
     * @return null|AbstractItem[] Items when in cache
     */
    public function getByPage($pageUid, array $loadObjects)
    {
        $items = null;

        if ($this->hasByPage($pageUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            $items = $this->itemsByPage[$pageUid][$objectsIdentifier];
        }

        return $items;
    }

    /**
     * Store an item in the cache
     *
     * @param int $itemUid The uid of the survey item
     * @param AbstractItem $item The item
     * @param array $loadObjects The nested models which should be loaded
     */
    public function storeByUid($itemUid, $item, array $loadObjects)
    {
        if (!$this->hasByUid($itemUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            if (!isset($this->itemsByUid[$itemUid])) {
                $this->itemsByUid[$itemUid] = [
                    $objectsIdentifier => $item
                ];
            } else {
                $this->itemsByUid[$itemUid][$objectsIdentifier] = $item;
            }
        }
    }

    /**
     * Store items in the cache by their survey page
     *
     * @param int $pageUid The uid of the survey item
     * @param AbstractItem[] $items The items
     * @param array $loadObjects The nested models which should be loaded
     */
    public function storeByPage($pageUid, $items, array $loadObjects)
    {
        if (!$this->hasByPage($pageUid, $loadObjects)) {
            $objectsIdentifier = $this->getObjectsIdentifier($loadObjects);

            if (!isset($this->itemsByPage[$pageUid])) {
                $this->itemsByPage[$pageUid] = [
                    $objectsIdentifier => $items
                ];
            } else {
                $this->itemsByPage[$pageUid][$objectsIdentifier] = $items;
            }
        }
    }

    /**
     * Get the objects identifier
     *
     * @param array $loadObjects The nested models which should be loaded
     * @return string
     */
    protected function getObjectsIdentifier(array $loadObjects)
    {
        if (empty($loadObjects)) {
            $objectIdentifier = 'none';
        } else {
            $objectIdentifier = implode('_', asort($loadObjects));
        }

        return $objectIdentifier;
    }
}