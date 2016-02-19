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

use PatrickBroens\Pbsurvey\Configuration\ApplicationConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Configuration manager
 */
class ConfigurationManager
{
    /**
     * The configuration
     *
     * @var ApplicationConfiguration
     */
    protected $configuration;

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
     * Constructor
     *
     * Set the configuration and emit a signal to populate
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentElementConfiguration The settings of the content element
     */
    public function __construct($typoScriptConfiguration, $contentElementConfiguration)
    {
        $this->configuration = GeneralUtility::makeInstance(ApplicationConfiguration::class);
        $this->signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);

        $this->contentElementConfiguration = $contentElementConfiguration;
        $this->typoScriptConfiguration = $typoScriptConfiguration;

    }

    /**
     * Get the configuration
     *
     * @return ApplicationConfiguration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Populate the configuration
     */
    public function populate()
    {
        $this->emitPopulateConfigurationSignal();
    }

    /**
     * Emit signal to populate the configuration
     */
    protected function emitPopulateConfigurationSignal()
    {
        $this->signalSlotDispatcher->dispatch(
            __CLASS__,
            'PopulateConfiguration',
            [
                $this->configuration,
                $this->typoScriptConfiguration,
                $this->contentElementConfiguration
            ]
        );
    }
}