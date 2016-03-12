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

use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
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
     *
     * Make the item 2 dimensional
     */
    public function initialize()
    {
        $this->options = $this->optionRows = [];

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
                $option->setLabel($this->getLanguageService()->sL(
                    static::$languageLabel . $predefinedOptionUid
                ));

                if ($predefinedOptionUid === $this->getValueDefaultBoolean()) {
                    $option->setChecked(true);
                }

                $this->addOption($option);
            }
        }

        /** @var OptionRow $optionRow */
        $optionRow = GeneralUtility::makeInstance(OptionRow::class);
        $optionRow->setUid(0);

        $optionRow->addOptions($this->getOptions());

        $this->addOptionRow($optionRow);
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
     * Get the default boolean value
     *
     * @return int
     */
    public function getValueDefaultBoolean()
    {
        return $this->valueDefaultBoolean;
    }
}