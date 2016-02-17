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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsResponsesTrait;

/**
 * Item type 23: Choice - Multiple Answers (Selectbox)
 */
class ItemType23 extends AbstractChoice
{
    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'containment',
        'provision'
    ];

    /**
     * The height of the selectbox
     *
     * @var int
     */
    protected $selectboxHeight;

    /**
     * TRAIT: OptionsRandomTrait
     *
     * FIELDS:
     * $optionsRandom
     */
    use OptionsRandomTrait;

    /**
     * TRAIT: OptionsResponsesTrait
     *
     * FIELDS:
     * $optionsResponsesMaximum
     * $optionsResponsesMinimum
     */
    use OptionsResponsesTrait;

    /**
     * Get the height of the selectbox
     *
     * @return int
     */
    public function getSelectboxHeight()
    {
        return $this->selectboxHeight;
    }

    /**
     * Set the height of the selectbox
     *
     * @param int $selectboxHeight The height
     */
    public function setSelectboxHeight($selectboxHeight)
    {
        $this->selectboxHeight = (int)$selectboxHeight;
    }
}