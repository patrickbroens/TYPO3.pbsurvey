<?php
namespace PatrickBroens\Pbsurvey\Configuration\Populator;

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

/**
 * Application configuration populator interface
 */
interface ConfigurationPopulatorInterface
{
    /**
     * Populate the application configuration based on settings in the content element
     *
     * @param ApplicationConfiguration $configuration
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentObjectConfiguration The content object configuration
     */
    public function populate(
        ApplicationConfiguration $configuration,
        array $typoScriptConfiguration,
        array $contentObjectConfiguration
    );

}