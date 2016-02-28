<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\AnswersNoneTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;

/**
 * Boolean question abstract
 */
abstract class AbstractBoolean extends AbstractChoice
{
    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'provision'
    ];

    /**
     * The language label
     *
     * @var string
     */
    protected static $languageLabel = '';

    /**
     * The predefined options with the positive value first
     *
     * @var array
     */
    protected static $predefinedOptionsPositiveFirst = [0, 2, 1];

    /**
     * The predefined options with the negative value first
     *
     * @var array
     */
    protected static $predefinedOptionsNegativeFirst = [0, 1, 2];

    /**
     * The options
     *
     * @var Option[]
     */
    protected $options = [];

    /**
     * TRAIT: AnswersNoneTrait
     *
     * FIELDS:
     * $anwersNone
     */
    use AnswersNoneTrait;

    /**
     * Negative value (false/no) first in order
     *
     * @var bool
     */
    protected $negativeFirst;

    /**
     * Default boolean value
     *
     * Not in use here but in question types using this abstract
     *
     * @var int
     */
    protected $valueDefaultBoolean;

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->options = [];

        $predefinedOptions = $this->isNegativeFirst()
            ? static::$predefinedOptionsNegativeFirst
            : static::$predefinedOptionsPositiveFirst;


        foreach ($predefinedOptions as $predefinedOptionUid) {
            if (
                (
                    $predefinedOptionUid === 0
                    && $this->getAnswersNone()
                )
                || $predefinedOptionUid !== 0
            ) {
                /** @var Option $option */
                $option = GeneralUtility::makeInstance(Option::class);
                $option->setUid($predefinedOptionUid);
                $option->setValue($this->getLanguageService()->sL(
                    static::$languageLabel . $predefinedOptionUid
                ));

                if ($predefinedOptionUid === $this->getValueDefaultBoolean()) {
                    $option->setChecked(true);
                }

                $this->addOption($option);
            }
        }
    }

    /**
     * Check if the negative option should be displayed first
     *
     * @return bool
     */
    public function isNegativeFirst()
    {
        return $this->negativeFirst;
    }

    /**
     * Check if the positive option should be displayed first
     *
     * @return bool
     */
    public function isPositiveFirst()
    {
        return !$this->negativeFirst;
    }

    /**
     * Set if negative value is first in order
     *
     * @param bool $negativeFirst true if negative value is first
     */
    public function setNegativeFirst($negativeFirst)
    {
        $this->negativeFirst = (bool)$negativeFirst;
    }

    /**
     * Add an option
     *
     * @param Option $option The option
     */
    public function addOption(Option $option)
    {
        $this->options[$option->getUid()] = $option;
    }

    /**
     * Get an option by its uid
     *
     * @param int $optionUid The option uid
     * @return null|Option
     */
    public function getOption($optionUid)
    {
        $option = null;

        if ($this->hasOption($optionUid)) {
            $option = $this->options[$optionUid];
        }

        return $option;
    }

    /**
     * Check if option exists
     *
     * @param int $optionUid The option uid
     * @return bool true if option exists
     */
    public function hasOption($optionUid)
    {
        return isset($this->options[$optionUid]);
    }

    /**
     * Check if the item contains options (answers)
     *
     * This type has predefined options, so this is always true
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return !empty($this->options);
    }

    /**
     * Get the options
     *
     * Since the type has predefined options, we collect them here
     *
     * @return Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get the default boolean value
     *
     * @return int
     */
    public function getValueDefaultBoolean()
    {
        return $this->valueDefaultBoolean;
    }
}