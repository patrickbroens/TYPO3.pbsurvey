<?php
namespace PatrickBroens\Pbsurvey\Controller;

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
use TYPO3\CMS\Extbase\Service\TypoScriptService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Dispatcher
 */
class Dispatcher
{
    /**
     * The content object renderer
     *
     * @var ContentObjectRenderer
     */
    public $cObj;

    /**
     * Executes the dispatcher
     *
     * @param string $content Not used
     * @param array $typoScriptConfiguration TypoScript configuration
     * @return string The rendered view
     */
    public function execute($content, array $typoScriptConfiguration)
    {
        $this->setConfiguration($typoScriptConfiguration);

        return $this->dispatch();
    }

    /**
     * Dispatch
     *
     * @return string The rendered view
     */
    protected function dispatch()
    {
        $output = 'Dispatch';

        return $output;
    }

    /**
     * Populate the application configuration with TypoScript and content element configuration
     *
     * @param array $typoScriptConfiguration The TypoScript configuration
     */
    protected function setConfiguration(array $typoScriptConfiguration)
    {
        /** @var ApplicationConfiguration $configuration */
        $configuration = GeneralUtility::makeInstance(ApplicationConfiguration::class);
        $configuration->populate($typoScriptConfiguration, $this->cObj->data);
    }
}