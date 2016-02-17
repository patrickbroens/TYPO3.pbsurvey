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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\AnswersAdditionalTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsAlignmentTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsRandomTrait;

/**
 * Item type 3: Choice - One Answer (Option Buttons)
 */
class ItemType3 extends AbstractChoice
{
    /**
     * TRAIT: AnswersAdditionalTrait
     *
     * FIELDS:
     * $answersAdditionalAllow
     * $answersAdditionalText
     * $answersAdditionalType
     * $textareaHeight
     * $textareaWidth
     */
    use AnswersAdditionalTrait;

    /**
     * TRAIT: OptionsAlignmentTrait
     *
     * FIELDS:
     * $optionsAlignment
     */
    use OptionsAlignmentTrait;

    /**
     * TRAIT: OptionsRandomTrait
     *
     * FIELDS:
     * $optionsRandom
     */
    use OptionsRandomTrait;

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
}