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
 * Image trait
 */
trait Image
{
    /**
     * The image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * Get the image file reference
     *
     * @return FileReference
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the image
     *
     * @param FileReference $image The file reference
     */
    public function setImage(FileReference $image)
    {
        $this->image = $image;
    }
}