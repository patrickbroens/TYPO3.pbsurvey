<?php
namespace PatrickBroens\Pbsurvey\DataProvider;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Option provider
 */
class OptionProvider
{
    /**
     * The options
     *
     * @var Option[]
     */
    protected $options = [];

    /**
     * Add an option
     *
     * @param Option $option The option
     */
    public function addSingle(Option $option)
    {
        $this->options[$option->getUid()] = $option;
    }

    /**
     * Get the amount of options
     *
     * @return int
     */
    public function getCount()
    {
        return count($this->options);
    }
}