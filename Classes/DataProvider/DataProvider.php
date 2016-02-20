<?php
namespace PatrickBroens\Pbsurvey\DataProvider;

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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Data provider
 */
class DataProvider implements SingletonInterface
{    /**
     * The item provider
     *
     * @var ItemProvider
     */
    protected $itemProvider;

    /**
     * The option provider
     *
     * @var OptionProvider
     */
    protected $optionProvider;

    /**
     * The option row provider
     *
     * @var OptionRowProvider
     */
    protected $optionRowProvider;

    /**
     * The survey pages provider
     *
     * @var PageProvider
     */
    protected $pageProvider;

    /**
     * The page condition group provider
     *
     * @var PageConditionGroupProvider
     */
    protected $pageConditionGroupProvider;

    /**
     * The page condition rule provider
     *
     * @var PageConditionRuleProvider
     */
    protected $pageConditionRuleProvider;

    /**
     * The storage folder
     *
     * @var int
     */
    protected $storageFolder;

    /**
     * Set the configuration and the providers and populates them
     *
     * @param int $storageFolder The storageFolder
     */
    public function initialize($storageFolder = 0)
    {
        $this->storageFolder = $storageFolder;

        $this->setProviders();

        $this->populate();
    }

    /**
     * Get a provider by name
     *
     * @param string $providerName
     * @return null|object
     */
    public function getProvider($providerName)
    {
        $providerName = lcfirst($providerName) . 'Provider';

        if (!isset($this->{$providerName})) {
            return null;
        }

        return $this->{$providerName};
    }

    /**
     * Get the storage folder
     *
     * @return int
     */
    public function getStorageFolder()
    {
        return $this->storageFolder;
    }

    /**
     * Populate the providers
     */
    protected function populate()
    {
        $this->pageProvider->populate();
    }

    /**
     * Set the providers
     */
    protected function setProviders()
    {
        $this->pageProvider = GeneralUtility::makeInstance(PageProvider::class);
        $this->itemProvider = GeneralUtility::makeInstance(ItemProvider::class);
        $this->pageConditionGroupProvider = GeneralUtility::makeInstance(PageConditionGroupProvider::class);
        $this->pageConditionRuleProvider = GeneralUtility::makeInstance(PageConditionRuleProvider::class);
        $this->optionProvider = GeneralUtility::makeInstance(OptionProvider::class);
        $this->optionRowProvider = GeneralUtility::makeInstance(OptionRowProvider::class);
    }
}