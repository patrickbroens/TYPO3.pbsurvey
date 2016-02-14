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

use PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined;

/**
 * Predefined option group
 */
class OptionPredefinedGroup extends AbstractModel
{
    /**
     * The name of the group
     *
     * @var string
     */
    protected $name;

    /**
     * The predefined options
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined []
     */
    protected $options;

    /**
     * Get the name
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name The name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * Check if the group contains options
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return !empty($this->options);
    }

    /**
     * Get the options
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add an option
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined $option The option
     */
    public function addOption(OptionPredefined $option)
    {
        $this->options[] = $option;
    }

    /**
     * Add options
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined[] $options The options
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            if ($option instanceof OptionPredefined) {
                $this->addOption($option);
            }
        }
    }
}