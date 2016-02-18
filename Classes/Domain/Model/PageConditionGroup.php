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
 * Page condition group
 */
class PageConditionGroup extends AbstractModel
{
    /**
     * The condition rules
     *
     * @var PageConditionRule[]
     */
    protected $rules;

    /**
     * The group name
     *
     * @var string
     */
    protected $name;

    /**
     * Check if the condition group contains rules
     *
     * @return bool true when rules are available
     */
    public function hasRules()
    {
        return !empty($this->rules);
    }

    /**
     * Get the rules
     *
     * @return PageConditionRule[]
     */
    public function getRule()
    {
        return $this->rules;
    }

    /**
     * Add a rule
     *
     * @param PageConditionRule $rule The rule
     */
    public function addRule(PageConditionRule $rule)
    {
        $this->rules[] = $rule;
    }

    /**
     * Add rules
     *
     * @param PageConditionRule[] $rules The rules
     */
    public function addRules(array $rules)
    {
        foreach ($rules as $rule) {
            if ($rule instanceof PageConditionRule) {
                $this->addRule($rule);
            }
        }
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name The name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }
}