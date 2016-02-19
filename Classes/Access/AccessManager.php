<?php
namespace PatrickBroens\Pbsurvey\Access;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Access manager
 */
class AccessManager
{
    /**
     * The access provider
     *
     * @var AccessProvider
     */
    protected $accessProvider;

    /**
     * The configuration
     *
     * @var ApplicationConfiguration
     */
    protected $configuration;

    /**
     * The signal/slot dispatcher
     *
     * @var Dispatcher
     */
    protected $signalSlotDispatcher;

    /**
     * Constructor
     *
     * Set the configuration and emit a signal to populate
     */
    public function __construct()
    {
        $this->accessProvider = GeneralUtility::makeInstance(AccessProvider::class);
        $this->configuration = GeneralUtility::makeInstance(ApplicationConfiguration::class);
        $this->signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);

        $this->emitCheckAccessSignal();
    }

    /**
     * Get the access provider
     *
     * @return AccessProvider
     */
    public function getAccessProvider()
    {
        return $this->accessProvider;
    }

    /**
     * Emit signal to check the access to the survey
     */
    protected function emitCheckAccessSignal()
    {
        $this->signalSlotDispatcher->dispatch(
            __CLASS__,
            'CheckAccess',
            [
                $this->accessProvider,
                $this->configuration
            ]
        );

        $this->accessProvider->setAccess($this->accessProvider->hasError());
    }
}