<?php
namespace PatrickBroens\Pbsurvey\Provider\Element;

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

use PatrickBroens\Pbsurvey\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Element factory
 */
class ElementFactory
{
    /**
     * Set the provider and populate it
     *
     * @param int $storageFolder The storageFolder
     * @return PageProvider
     */
    public function initialize($storageFolder = 0)
    {
        /** @var PageProvider $pageProvider */
        $pageProvider = GeneralUtility::makeInstance(PageProvider::class);

        $this->populate($storageFolder, $pageProvider);

        return $pageProvider;
    }

    /**
     * Populate the providers
     *
     * @param int $storageFolder The storageFolder
     * @param PageProvider $pageProvider The page provider
     */
    protected function populate($storageFolder, PageProvider $pageProvider)
    {
        $pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $pageProvider->addPages($pageRepository->findByPid($storageFolder));
    }
}