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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\AnswersAdditionalText;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\Options;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\OptionsResponses;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\Question;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\QuestionSubtext;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Field\Styleclass;

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
    use AnswersAdditionalText;

    /**
     * TRAIT: Options
     *
     * FIELDS:
     * $options
     */
    use Options;

    /**
     * TRAIT: OptionsReponses
     *
     * FIELDS:
     * $optionsResponsesMaximum
     * $optionsResponsesMinimum
     */
    use OptionsResponses;

    /**
     * TRAIT: Question
     *
     * FIELDS:
     * $optionsRequired
     * $question
     * $questionAlias
     */
    use Question;

    /**
     * TRAIT QuestionSubtext
     *
     * FIELDS:
     * $questionSubtext
     */
    use QuestionSubtext;

    /**
     * TRAIT: Styleclass
     *
     * FIELDS:
     * $styleclass
     */
    use Styleclass;
}