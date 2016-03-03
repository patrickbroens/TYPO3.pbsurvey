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
 * Option row
 */
class OptionRow extends AbstractModel
{
    /**
     * The label
     *
     * @var string
     */
    protected $label;

    /**
     * The options
     *
     * @var Option[]
     */
    protected $options = [];

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

    /**
     * Add an option
     *
     * The option needs to be cloned from the original one
     * Otherwise we have direct references
     *
     * @param Option $option
     */
    public function addOption(Option $option)
    {
        $this->options[$option->getUid()] = clone $option;
    }

    /**
     * Add options
     *
     * @param Option[] $options The options
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    /**
     * Get an option
     *
     * @param int $optionUid The option uid
     * @return null|Option
     */
    public function getOption($optionUid)
    {
        $option = null;

        if ($this->hasOption($optionUid)) {
            $option = $this->options[$optionUid];
        }

        return $option;
    }

    /**
     * Get the options
     *
     * @return Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Check if option is available
     *
     * @param int $optionUid The option uid
     * @return bool
     */
    public function hasOption($optionUid)
    {
        return !empty($this->options[$optionUid]);
    }
}