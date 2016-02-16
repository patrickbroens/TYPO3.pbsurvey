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
 * Default value for true/false question trait
 */
trait DisplayTypeTrait
{
    /**
     * Display Type
     *
     * Can be dropdown, radio buttons horizontal/vertical
     *
     * @var int
     */
    protected $displayType;

    /**
     * Get the display type
     *
     * @return int
     */
    public function getDisplayType()
    {
        return $this->displayType;
    }

    /**
     * Set the display type
     *
     * @param int $displayType the type
     */
    public function setDisplayType($displayType)
    {
        $this->displayType = (int)$displayType;
    }
}