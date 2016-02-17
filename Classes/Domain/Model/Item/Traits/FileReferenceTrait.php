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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\FileReference;
use PatrickBroens\Pbsurvey\Domain\Model\Option;

/**
 * File reference trait
 */
trait FileReferenceTrait
{
    /**
     * The file references
     *
     * @var \TYPO3\CMS\Core\Resource\FileReference[]
     */
    protected $fileReferences;

    /**
     * Check if a file reference exists
     *
     * @param int $fileReferenceUid The file reference uid
     * @return bool true if file reference exists
     */
    public function hasFileReference($fileReferenceUid)
    {
        return isset($this->fileReferences[$fileReferenceUid]);
    }

    /**
     * Check if option exists
     *
     * In this case an option is a file reference
     *
     * @param int $fileReferenceUid The file reference uid
     * @return bool true if file reference exists
     */
    public function hasOption($fileReferenceUid)
    {
        return $this->hasFileReference($fileReferenceUid);
    }

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
     * Check if the item contains options (answers)
     *
     * In this case an option is a file reference
     *
     * @return bool true when options are available
     */
    public function hasOptions()
    {
        return $this->hasFileReferences();
    }

    /**
     * Get a file reference by its uid
     *
     * @param int $fileReferenceUid The file reference uid
     * @return null|\TYPO3\CMS\Core\Resource\FileReference The option
     */
    public function getFileReference($fileReferenceUid)
    {
        $fileReference = null;

        if ($this->hasFileReference($fileReferenceUid)) {
            $fileReference = $this->fileReferences[$fileReferenceUid];
        }

        return $fileReference;
    }

    /**
     * Get an option by its uid
     *
     * In this case an option is a file reference
     *
     * @param int $fileReferenceUid The file reference uid
     * @return null|\PatrickBroens\Pbsurvey\Domain\Model\Option The option
     */
    public function getOption($fileReferenceUid)
    {
        $option = null;

        if ($this->hasOption($fileReferenceUid)) {
            $fileReference = $this->fileReferences[$fileReferenceUid];

            $name = $fileReference->getName();
            $title = $fileReference->getTitle();

            $option = GeneralUtility::makeInstance(Option::class);
            $option->setUid($fileReferenceUid);
            $option->setValue($title ?: $name);
        }

        return $option;
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
     * Get the options
     *
     * @return \PatrickBroens\Pbsurvey\Domain\Model\Option[]
     */
    public function getOptions()
    {
        $options = [];

        foreach ($this->fileReferences as $fileReference) {
            $options[] = $this->getOption($fileReference->getUid());
        }

        return $options;
    }

    /**
     * Add a file reference
     *
     * @param \TYPO3\CMS\Core\Resource\FileReference $fileReference The file reference
     */
    public function addFileReference(FileReference $fileReference)
    {
        $this->fileReferences[$fileReference->getUid()] = $fileReference;
    }

    /**
     * Add file references
     *
     * @param \TYPO3\CMS\Core\Resource\FileReference[] $images The images file references
     */
    public function addFileReferences(array $fileReferences)
    {
        foreach ($fileReferences as $fileReference) {
            if ($fileReference instanceof FileReference) {
                $this->addFileReference($fileReference);
            }
        }
    }








}