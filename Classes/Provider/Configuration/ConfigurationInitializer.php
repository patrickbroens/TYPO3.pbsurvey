<?php
namespace PatrickBroens\Pbsurvey\Provider\Configuration;

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
     * Initialize the configuration initializer
     *
     * Set the configuration provider and emit a signal to populate
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentElementConfiguration The settings of the content element
     * @return ConfigurationProvider
     */
    public function initialize($typoScriptConfiguration, $contentElementConfiguration)
    {
        /** @var ConfigurationProvider $configurationProvider */
        $configurationProvider = GeneralUtility::makeInstance(ConfigurationProvider::class);

        $this->emitConfigurationPopulateSignal(
            $configurationProvider,
            $typoScriptConfiguration,
            $contentElementConfiguration
        );

        return $configurationProvider;
    }

    /**
     * Emit signal to populate the configuration
     *
     * @param ConfigurationProvider $configurationProvider The configuration provider
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentElementConfiguration The settings of the content element
     */
    protected function emitConfigurationPopulateSignal(
        ConfigurationProvider $configurationProvider,
        array $typoScriptConfiguration,
        array $contentElementConfiguration
    )
    {
        /** @var Dispatcher $signalSlotDispatcher */
        $signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcher->dispatch(
            __CLASS__,
            'ConfigurationPopulate',
            [
                $configurationProvider,
                $typoScriptConfiguration,
                $contentElementConfiguration
            ]
        );
    }
}