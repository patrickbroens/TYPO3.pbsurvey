<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item\Traits;

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
 * Image configuration trait
 */
trait ImageConfigurationTrait
{
    /**
     * The image alignment
     *
     * @var int
     */
    protected $imageAlignment;

    /**
     * The image height
     *
     * @var int
     */
    protected $imageHeight;

    /**
     * The image width
     *
     * @var int
     */
    protected $imageWidth;


    /**
     * Get the image alignment
     *
     * @return int
     */
    public function getImageAlignment()
    {
        return $this->imageAlignment;
    }

    /**
     * Set the image alignment
     *
     * @param int $imageAlignment The image alignment
     */
    public function setImageAlignment($imageAlignment)
    {
        $this->imageAlignment = (int)$imageAlignment;
    }

    /**
     * Get the image height
     *
     * @return int
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * Set the image height
     *
     * @param int $imageHeight The image height
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = (int)$imageHeight;
    }

    /**
     * Get the image width
     *
     * @return int
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * Set the image width
     *
     * @param int $imageWidth The image width
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = (int)$imageWidth;
    }
}