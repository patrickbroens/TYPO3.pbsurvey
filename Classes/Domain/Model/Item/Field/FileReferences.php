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
 * FileReferences trait
 */
trait FileReferences
{
    /**
     * The file references
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference[]
     */
    protected $fileReferences;

    /**
     * Check if the item contains file references
     *
     * @return bool true when file references are available
     */
    public function hasFileReferences()
    {
        return !empty($this->fileReferences);
    }

    /**
     * Get the file references
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference[]
     */
    public function getFileReferences()
    {
        return $this->fileReferences;
    }

    /**
     * Add a file reference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference The file reference
     */
    public function addFileReference(FileReference $fileReference)
    {
        $this->fileReferences[] = $fileReference;
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