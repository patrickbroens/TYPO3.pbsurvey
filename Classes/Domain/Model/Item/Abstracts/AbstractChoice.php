<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts;

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

use PatrickBroens\Pbsurvey\Domain\Model\Option;

/**
 * Choice question abstract
 */
abstract class AbstractChoice extends AbstractQuestion
{
    /**
     * The options
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    protected $options;

    /**
     * Check if option exists
     *
     * @param int $optionUid The option uid
     * @return bool true if option exists
     */
    public function hasOption($optionUid)
    {
        return isset($this->options[$optionUid]);
    }

    /**
     * Check if the item contains options (answers)
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return !empty($this->options);
    }

    /**
     * Get an option by its uid
     *
     * @param int $optionUid The option uid
     * @return null|\PatrickBroens\Pbsurvey\Domain\Model\Option The option
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
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add an option
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Option $option The option
     */
    public function addOption(Option $option)
    {
        $this->options[$option->getUid()] = $option;
    }

    /**
     * Add options
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Option[] $options The options
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            if ($option instanceof \PatrickBroens\Pbsurvey\Domain\Model\Option) {
                $this->addOption($option);
            }
        }
    }
}