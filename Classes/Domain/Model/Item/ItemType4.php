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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractBoolean;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\DisplayTypeTrait;

/**
 * Item type 4: Choice - True/False
 */
class ItemType4 extends AbstractBoolean
{
    /**
     * TRAIT: DisplayTypeTrait
     *
     * FIELDS:
     * $displayType
     */
    use DisplayTypeTrait;

    /**
     * The language label
     *
     * @var string
     */
    protected static $languageLabel = 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Item.xlf:field.value_default_true_false.';

    /**
     * Negative value (false/no) first in order
     *
     * @var int
     */
    protected $valueDefaultTrueFalse;

    /**
     * Get the default value
     *
     * @return int
     */
    public function getValueDefaultTrueFalse()
    {
        return $this->valueDefaultTrueFalse;
    }

    /**
     * Set the default value
     *
     * @param int $valueDefaultTrueFalse the value
     */
    public function setValueDefaultTrueFalse($valueDefaultTrueFalse)
    {
        $this->valueDefaultTrueFalse = (int)$valueDefaultTrueFalse;
    }
}