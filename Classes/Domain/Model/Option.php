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
 * Option
 */
class Option extends AbstractModel
{
    /**
     * The answer
     *
     * @var string
     */
    protected $answer;

    /**
     * Should the option be checked by default
     *
     * @var bool
     */
    protected $checked;

    /**
     * The scoring points
     *
     * @var int
     */
    protected $points;

    /**
     * The value
     *
     * @var string
     */
    protected $value;

    /**
     * Get the answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set the answer
     *
     * @param string $answer The answer
     */
    public function setAnswer($answer)
    {
        $this->answer = (string)$answer;
    }

    /**
     * Check if the option should be checked
     *
     * @return bool
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set if the option should be checked
     *
     * @param bool $checked true is checked
     */
    public function setChecked($checked)
    {
        $this->checked = (bool)$checked;
    }

    /**
     * Get the scoring points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set the scoring points
     *
     * @param int $points The scoring points
     */
    public function setPoints($points)
    {
        $this->points = (int)$points;
    }

    /**
     * Get the value
     *
     * @return string The value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value
     *
     * @param string $value The value
     */
    public function setValue($value)
    {
        $this->value = (string)$value;
    }
}