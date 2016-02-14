<?php
namespace PatrickBroens\Pbsurvey\Domain\Model;

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
 * Predefined option
 */
class OptionPredefined extends AbstractModel
{
    /**
     * The label of the option
     *
     * @var string
     */
    protected $label;

    /**
     * Get the label
     *
     * @return string The label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the label
     *
     * @param string $label The label
     */
    public function setLabel($label)
    {
        $this->label = (string)$label;
    }
}