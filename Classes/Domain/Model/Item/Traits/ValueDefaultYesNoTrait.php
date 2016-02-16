<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Traits;

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
 * Default value for yes/no question trait
 */
trait ValueDefaultYesNoTrait
{
    /**
     * Negative value (false/no) first in order
     *
     * @var int
     */
    protected $valueDefaultYesNo;

    /**
     * Get the default value
     *
     * @return int
     */
    public function getValueDefaultYesNo()
    {
        return $this->valueDefaultYesNo;
    }

    /**
     * Set the default value
     *
     * @param int $valueDefaultYesNo the value
     */
    public function setOptionsRandom($valueDefaultYesNo)
    {
        $this->valueDefaultYesNo = (int)$valueDefaultYesNo;
    }
}