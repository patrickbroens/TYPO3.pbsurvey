<?php
namespace PatrickBroens\Pbsurvey\Configuration;

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
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Configuration initializer
 */
class ConfigurationInitializer
{
    /**
     * The configuration provider
     *
     * @var ConfigurationProvider
     */
    protected $configurationProvider;

    /**
     * The settings of the content element
     *
     * @var array
     */
    protected $contentElementConfiguration;

    /**
     * The signal/slot dispatcher
     *
     * @var Dispatcher
     */
    protected $signalSlotDispatcher;

    /**
     * The TypoScript configuration
     *
     * @var array
     */
    protected $typoScriptConfiguration;

    /**
     * Initialize the configuration initializer
     *
     * Set the configuration and emit a signal to populate
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentElementConfiguration The settings of the content element
     */
    public function initialize($typoScriptConfiguration, $contentElementConfiguration)
    {
        $this->configurationProvider = GeneralUtility::makeInstance(ConfigurationProvider::class);
        $this->signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $this->contentElementConfiguration = $contentElementConfiguration;
        $this->typoScriptConfiguration = $typoScriptConfiguration;

        $this->emitConfigurationPopulateSignal();
    }

    /**
     * Emit signal to populate the configuration
     */
    protected function emitConfigurationPopulateSignal()
    {
        $this->signalSlotDispatcher->dispatch(
            __CLASS__,
            'ConfigurationPopulate',
            [
                $this->configurationProvider,
                $this->typoScriptConfiguration,
                $this->contentElementConfiguration
            ]
        );
    }
}