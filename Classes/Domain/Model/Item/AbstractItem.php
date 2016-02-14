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

use PatrickBroens\Pbsurvey\Domain\Model\AbstractModel;

/**
 * Abstract
 */
class AbstractItem extends AbstractModel
{
    /**
     * The type
     *
     * @var int
     */
    protected static $type = 1;

    /**
     * Question or presentation?
     *
     * @var bool
     */
    protected static $presentationType = true;

    /**
     * Check if this item is a question or a presentation
     *
     * @return bool
     */
    public function isQuestion()
    {
        return static::$presentationType === false;
    }
}