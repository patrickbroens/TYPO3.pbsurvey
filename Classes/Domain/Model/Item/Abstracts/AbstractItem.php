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

use PatrickBroens\Pbsurvey\Domain\Model\AbstractModel;

/**
 * Item abstract
 */
abstract class AbstractItem extends AbstractModel
{
    /**
     * The question type
     *
     * @var int
     */
    protected $questionType;

    /**
     * Initialize the item
     */
    public function initialize()
    {
    }

    /**
     * Get the question type
     *
     * @return int
     */
    public function getQuestionType()
    {
        return $this->questionType;
    }

    /**
     * Set the question type
     *
     * @param int $questionType The question type
     */
    public function setQuestionType($questionType)
    {
        $this->questionType = (int)$questionType;
    }
}