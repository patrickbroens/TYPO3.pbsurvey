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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;

/**
 * Page
 */
class Page extends AbstractModel
{
    /**
     * The condition groups
     *
     * @var PageConditionGroup[]
     */
    protected $conditionGroups;

    /**
     * The page introduction
     *
     * @var string
     */
    protected $introduction;

    /**
     * The items
     *
     * @var AbstractItem[]
     */
    protected $items = [];

    /**
     * The page title
     *
     * @var string
     */
    protected $title;

    /**
     * Check if a condition group is available
     *
     * @param int $uid The uid of the condition group
     * @return bool true if available
     */
    public function hasConditionGroup($uid)
    {
        return isset($this->conditionGroups[$uid]) && !empty($this->conditionGroups[$uid]);
    }

    /**
     * Get a condition group by its uid
     *
     * @param int $uid The uid of the condition group
     * @return null|PageConditionGroup
     */
    public function getConditionGroup($uid)
    {
        $conditionGroup = null;

        if ($this->hasConditionGroup($uid)) {
            $conditionGroup = $this->conditionGroups[$uid];
        }

        return $conditionGroup;
    }

    /**
     * Check if the page contains condition groups
     *
     * @return bool true when condition groups are available
     */
    public function hasConditionGroups()
    {
        return !empty($this->conditionGroups);
    }

    /**
     * Get the condition groups
     *
     * @return PageConditionGroup[]
     */
    public function getConditionGroups()
    {
        return $this->conditionGroups;
    }

    /**
     * Add a condition group
     *
     * @param PageConditionGroup $conditionGroup The condition group
     */
    public function addConditionGroup(PageConditionGroup $conditionGroup)
    {
        $this->conditionGroups[$conditionGroup->getUid()] = $conditionGroup;
    }

    /**
     * Add condition groups
     *
     * @param PageConditionGroup[] $conditionGroups The condition groups
     */
    public function addConditionGroups(array $conditionGroups)
    {
        foreach ($conditionGroups as $conditionGroup) {
            if ($conditionGroup instanceof PageConditionGroup) {
                $this->addConditionGroup($conditionGroup);
            }
        }
    }

    /**
     * Get the page introduction
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set the page introduction
     *
     * @param string $introduction The page introduction
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = (string)$introduction;
    }

    /**
     * Check if the page contains items
     *
     * @return bool true when items are available
     */
    public function hasItems()
    {
        return !empty($this->items);
    }

    /**
     * Get the items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get the item count
     *
     * @return int
     */
    public function getItemCount()
    {
        return count($this->items);
    }

    /**
     * Add an item
     *
     * @param AbstractItem $item The item
     */
    public function addItem(AbstractItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * Add an array of items
     *
     * @param AbstractItem[] $items The items
     */
    public function addItems(array $items)
    {
        foreach ($items as $item) {
            if ($item instanceof AbstractItem) {
                $this->addItem($item);
            }
        }
    }

    /**
     * Get the page title
     *
     * @return string The page title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the page title
     *
     * @param string $title The page title
     */
    public function setTitle($title)
    {
        $this->title = (string)$title;
    }
}