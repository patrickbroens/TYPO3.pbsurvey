<?php
namespace PatrickBroens\Pbsurvey\Provider\Configuration\Populate;

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

use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;

/**
 * Configuration populator interface
 */
interface ConfigurationPopulateInterface
{
    /**
     * @param ConfigurationProvider $configurationProvider
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentObjectConfiguration The content object configuration
     */
    public function populate(
        ConfigurationProvider $configurationProvider,
        array $typoScriptConfiguration,
        array $contentObjectConfiguration
    );
}