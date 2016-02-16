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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\AnswersAdditionalTextTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionsResponsesTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\QuestionTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\QuestionSubtextTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\StyleclassTrait;

/**
 * Item type 1
 */
class ItemType1 extends Choice
{
    /**
     * The type
     *
     * @var int
     */
    protected static $type = 1;

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
     * TRAIT: AnswersAdditionalText
     *
     * FIELDS:
     * $answersAdditionalAllow
     * $answersAdditionalText
     * $answersAdditionalType
     * $textareaHeight
     * $textareaWidth
     */
    use AnswersAdditionalTextTrait;

    /**
     * TRAIT: Options
     *
     * FIELDS:
     * $options
     */
    use OptionsTrait;

    /**
     * TRAIT: OptionsReponses
     *
     * FIELDS:
     * $optionsResponsesMaximum
     * $optionsResponsesMinimum
     */
    use OptionsResponsesTrait;

    /**
     * TRAIT: Question
     *
     * FIELDS:
     * $optionsRequired
     * $question
     * $questionAlias
     */
    use QuestionTrait;

    /**
     * TRAIT QuestionSubtext
     *
     * FIELDS:
     * $questionSubtext
     */
    use QuestionSubtextTrait;

    /**
     * TRAIT: Styleclass
     *
     * FIELDS:
     * $styleclass
     */
    use StyleclassTrait;
}