<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item;

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

use PatrickBroens\Pbsurvey\Domain\Model\AbstractModel;

/**
 * Question abstract
 */
class AbstractQuestion extends AbstractItem
{
    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [];

    /**
     * Question or presentation?
     *
     * @var bool
     */
    protected static $presentationType = false;

    /**
     * Open ended question
     *
     * @var bool
     */
    protected static $openEnded = false;

    /**
     * Choice question
     *
     * @var bool
     */
    protected static $choice = false;

    /**
     * Are the options predefined (yes/no, true/false)
     *
     * @var bool
     */
    protected static $predefinedOptions = false;

    /**
     * Check if an answer is mandatory
     *
     * @return bool
     */
    public function isRequired()
    {
        $required = false;

        if (method_exists($this, 'getOptionsRequired')) {
            $required = $this->getOptionsRequired();
        }

        return $required;
    }

    /**
     * Check if an additional answer is allowed
     *
     * @return bool
     */
    public function isAdditionalAllowed()
    {
        $hasAdditional = false;

        if (method_exists($this, 'getAnswersAdditionalAllow')) {
            $hasAdditional = $this->getAnswersAdditionalAllow();
        }

        return $hasAdditional;
    }

    /**
     * Check if the item contains options (answers)
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        $hasOptions = false;

        if (method_exists($this, 'getOptions')) {
            $hasOptions = !empty($this->getOptions());
        }

        return $hasOptions;
    }

    /**
     * Check if the options are predefined (yes/no, true/false)
     *
     * @return bool
     */
    public function isPredefinedOptions() {
        return static::$predefinedOptions;
    }

    /**
     * Check if the type is of choice type
     *
     * @return bool
     */
    public function isChoice()
    {
        return static::$choice;
    }

    /**
     * Check if the type is an open ended type
     *
     * @return bool
     */
    public function isOpenEnded()
    {
        return static::$openEnded;
    }

    /**
     * Get the allowed condition operator groups
     *
     * Removes the group 'provision' when an answer is mandatory
     *
     * @return array
     */
    public function getAllowedConditionOperatorGroups()
    {
        $allowedConditionOperatorGroups = static::$allowedConditionOperatorGroups;

        if (
            in_array('provision', $allowedConditionOperatorGroups)
            && $this->isRequired()
        ) {
            $provisionKey = array_search('provision', $allowedConditionOperatorGroups);
            unset($allowedConditionOperatorGroups[$provisionKey]);
        }

        return $allowedConditionOperatorGroups;
    }
}