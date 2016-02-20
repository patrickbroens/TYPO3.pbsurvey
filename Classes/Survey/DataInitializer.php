<?php
namespace PatrickBroens\Pbsurvey\Survey;

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
 * Data initializer
 */
class DataInitializer implements SingletonInterface
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
     * Set the configuration and the providers and populate them
     *
     * @param int $storageFolder The storageFolder
     */
    public function initialize($storageFolder = 0)
    {
        $this->setProviders();

        $this->populate($storageFolder);
    }

    /**
     * Populate the providers
     *
     * @param int $storageFolder The storageFolder
     */
    protected function populate($storageFolder)
    {
        $this->pageProvider->populate($storageFolder);
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