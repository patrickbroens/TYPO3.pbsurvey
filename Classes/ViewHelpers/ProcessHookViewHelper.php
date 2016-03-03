<?php
namespace PatrickBroens\Pbsurvey\ViewHelpers;

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

use PatrickBroens\Pbsurvey\Hook\CallUserDefinedHookInterface;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Add content from a hook
 *
 * This is old skool functionality which is left in here
 * since there might be people who came from a previous version
 */
class ProcessHookViewHelper extends AbstractViewHelper
{
    /**
     * Call a user defined hook
     *
     * @param ConfigurationProvider $configuration
     * @param UserProvider $user
     * @param PageProvider $pages
     * @return string
     */
    public function render(
        ConfigurationProvider $configuration,
        UserProvider $user,
        PageProvider $pages
    )
    {
        $output = '';

        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['tx_pbsurvey_pi1']['processHookItem'])) {
            foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['tx_pbsurvey_pi1']['processHookItem'] as $classReference) {
                $hookObject = GeneralUtility::getUserObj($classReference);
                if (!$hookObject instanceof CallUserDefinedHookInterface) {
                    throw new \UnexpectedValueException(
                        '$hookObject must implement interface ' . CallUserDefinedHookInterface::class,
                        1457011406
                    );
                }
                $output = (string)$hookObject->hookItemProcessor($configuration, $user, $pages);
            }
        }

        return $output;
    }
}
