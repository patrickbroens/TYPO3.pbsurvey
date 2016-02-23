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
use PatrickBroens\Pbsurvey\Utility\Reflection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\TypoScriptService;

/**
 * Configuration populator for TypoScript
 */
class TypoScriptConfigurationPopulate implements ConfigurationPopulateInterface
{
    /**
     * Populate the application configuration based on TypoScript
     *
     * @param ConfigurationProvider $configurationProvider
     * @param array $typoScriptConfiguration The TypoScript configuration
     * @param array $contentObjectConfiguration The content object configuration
     */
    public function populate(
        ConfigurationProvider $configurationProvider,
        array $typoScriptConfiguration,
        array $contentObjectConfiguration
    )
    {
        $typoScriptConfiguration = $this->prepareTypoScriptConfiguration($typoScriptConfiguration);

        $reflection = GeneralUtility::makeInstance(Reflection::class, $configurationProvider);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $type = $reflection->getPropertyTag($property, 'var');

            if (
                substr($type, -2) !== '[]'
                && is_callable([$configurationProvider, 'set' . ucfirst($property->name)])
            ) {
                $method = 'set' . ucfirst($property->name);

                if (isset($typoScriptConfiguration[$property->name])) {
                    $configurationProvider->$method($typoScriptConfiguration[$property->name]);
                }
            }
        }
    }

    /**
     * Removes all trailing dots recursively from TS settings array
     *
     * @param array $typoScriptConfiguration The TypoScript array with dots
     * @return array
     */
    protected function prepareTypoScriptConfiguration(array $typoScriptConfiguration)
    {
        /** @var $typoScriptService TypoScriptService */
        $typoScriptService = GeneralUtility::makeInstance(TypoScriptService::class);
        return $typoScriptService->convertTypoScriptArrayToPlainArray($typoScriptConfiguration);
    }
}