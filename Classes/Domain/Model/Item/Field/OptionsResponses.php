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
 * Options responses trait
 */
trait OptionsResponses
{
    /**
     * Maximum number of responses
     *
     * @var int
     */
    protected $optionsResponsesMaximum;

    /**
     * Minimum number of responses
     *
     * @var int
     */
    protected $optionsResponsesMinimum;

    /**
     * Get the maximum number of responses
     *
     * @return int
     */
    public function getOptionsResponsesMaximum()
    {
        return $this->optionsResponsesMaximum;
    }

    /**
     * Set the maximum number of responses
     *
     * @param int $optionsResponsesMaximum The maximum number of responses
     */
    public function setOptionsResponsesMaximum($optionsResponsesMaximum)
    {
        $this->optionsResponsesMaximum = (int)$optionsResponsesMaximum;
    }

    /**
     * Get the minimum number of responses
     *
     * @return int
     */
    public function getOptionsResponsesMinimum()
    {
        return $this->optionsResponsesMinimum;
    }

    /**
     * Set the minimum number of responses
     *
     * @param int $optionsResponsesMinimum The minimum number of responses
     */
    public function setOptionsResponsesMinimum($optionsResponsesMinimum)
    {
        $this->optionsResponsesMinimum = (int)$optionsResponsesMinimum;
    }
}