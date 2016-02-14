<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Field;

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

/**
 * Add none value to answers trait
 */
trait AnswersNone
{
    /**
     * Add --none-- value to answers
     *
     * @var bool
     */
    protected $anwersNone;

    /**
     * Check if the none value should be added
     *
     * @return bool
     */
    public function addNone()
    {
        return $this->anwersNone;
    }

    /**
     * Set if the none value should be added
     *
     * @param bool $anwersNone true if the none value is added
     */
    public function setAnswersNone($anwersNone)
    {
        $this->answersNone = (bool)$anwersNone;
    }
}