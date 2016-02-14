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
 * Styleclass trait
 */
trait Styleclass
{
    /**
     * The style class
     *
     * @var string
     */
    protected $styleclass;

    /**
     * Get the style class
     *
     * @return string
     */
    public function getStyleclass()
    {
        return $this->styleclass;
    }

    /**
     * Set the style class
     *
     * @param string $styleclass The style class
     */
    public function setStyleclass($styleclass)
    {
        $this->styleclass = (string)$styleclass;
    }
}