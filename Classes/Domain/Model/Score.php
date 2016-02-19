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
 * Score
 */
class Score extends AbstractModel
{
    /**
     * The page to redirect to
     *
     * @var int
     */
    protected $page;

    /**
     * The scored points needed
     *
     * @var int
     */
    protected $score;

    /**
     * Get the page to redirect to
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the page to redirect to
     *
     * @param int $page The page uid
     */
    public function setPage($page)
    {
        $this->page = (int)$page;
    }

    /**
     * Get the scored points needed
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the scored points needed
     *
     * @param int $score The scored points needed
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
}