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
 * FileReference trait
 */
trait Image
{
    /**
     * The file reference
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $fileReference;

    /**
     * Get the file reference
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getFileReference()
    {
        return $this->fileReference;
    }

    /**
     * Set the file reference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image The file reference
     */
    public function setFileReference(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference)
    {
        $this->fileReference = $fileReference;
    }
}