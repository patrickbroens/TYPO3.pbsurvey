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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionRowsTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 11: Open Ended - Constant Sum
 */
class OpenEndedConstantSum extends AbstractChoice
{
    /**
     * TRAIT: OptionsRandomTrait
     *
     * FIELDS:
     * $optionsRandom
     */
    use OptionsRandomTrait;

    /**
     * TRAIT: OptionRowsTrait
     *
     * FIELDS:
     * $optionRows
     */
    use OptionRowsTrait;

    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'containment',
        'mathematical',
        'provision'
    ];

    /**
     * Answer total
     *
     * @var int
     */
    protected $numberTotal;

    /**
     * Get the total number
     *
     * @return int
     */
    public function getNumberTotal()
    {
        return $this->numberTotal;
    }

    /**
     * Set the total number
     *
     * @param int $numberTotal The total number
     */
    public function setNumberTotal($numberTotal)
    {
        $this->numberTotal = (int)$numberTotal;
    }

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->options = [];

        foreach ($this->getOptionRows() as $optionRow) {
            /** @var Option $option */
            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($optionRow->getUid());
            $option->setLabel($optionRow->getName());

            $this->addOption($option);
        }
    }
}