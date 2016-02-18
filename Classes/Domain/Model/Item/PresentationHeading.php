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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractPresentation;

/**
 * Item type 17: Presentation - Heading
 */
class PresentationHeading extends AbstractPresentation
{
    /**
     * The heading
     *
     * @var string
     */
    protected $heading;

    /**
     * Get the heading
     *
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set the heading
     *
     * @param string $heading The heading
     */
    public function setHeading($heading)
    {
        $this->heading = (string)$heading;
    }
}