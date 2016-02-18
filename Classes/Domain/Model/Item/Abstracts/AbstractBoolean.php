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
     * The predefined options
     *
     * @var array
     */
    protected static $predefinedOptions = [0, 1, 2];

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
     * Check if option exists
     *
     * @param int $optionUid The option uid
     * @return bool true if option exists
     */
    public function hasOption($optionUid)
    {
        return isset(static::$predefinedOptions[$optionUid]);
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
        return true;
    }

    /**
     * Get an option by its uid
     *
     * Since the type has predefined options, we construct it here
     *
     * @param int $optionUid The option uid
     * @return null|Option The option
     */
    public function getOption($optionUid)
    {
        $option = null;

        if ($this->hasOption($optionUid)) {
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionUid);
            $option->setValue($this->getLanguageService()->sL(
                static::$languageLabel . $optionUid
            ));
        }

        return $option;
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
        $options = [];

        foreach (static::$predefinedOptions as $predefinedOptionUid) {
            if (
                (
                    $predefinedOptionUid === 0
                    && $this->addNone()
                )
                || $predefinedOptionUid !== 0
            ) {
                $options[] = $this->getOption($predefinedOptionUid);
            }
        }

        return $options;
    }
}