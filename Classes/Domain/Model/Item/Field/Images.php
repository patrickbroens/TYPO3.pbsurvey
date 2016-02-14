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

use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Images trait
 */
trait Images
{
    /**
     * The images file references
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference[]
     */
    protected $images;

    /**
     * Check if the item contains images
     *
     * @return bool true when images are available
     */
    public function hasImages()
    {
        return !empty($this->images);
    }

    /**
     * Get the images file references
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add an image file reference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image The image file reference
     */
    public function addImage(FileReference $image)
    {
        $this->images[] = $image;
    }

    /**
     * Add images
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference[] $images The images file references
     */
    public function addImages(array $images)
    {
        foreach ($images as $image) {
            if ($image instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference) {
                $this->addImage($image);
            }
        }
    }
}