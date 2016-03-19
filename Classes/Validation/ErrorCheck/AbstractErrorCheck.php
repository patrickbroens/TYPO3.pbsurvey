<?php
namespace PatrickBroens\Pbsurvey\Validation\ErrorCheck;

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

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Abstract error check
 */
abstract class AbstractErrorCheck
{
    /**
     * Get the error message
     *
     * More parameters are allowed. These are added to the message using vsprintf
     *
     * @param string $label The label
     * @return string The formatted error message
     */
    protected function getErrorMessage($label)
    {
        $arguments = func_get_args();
        array_shift($arguments);

        $errorMessage = LocalizationUtility::translate(
            'LLL:EXT:pbsurvey/Resources/Private/Language/Frontend.xlf:' . $label,
            'pbsurvey'
        );

        if (0 !== count($arguments)) {
            $errorMessage = vsprintf($errorMessage, $arguments);
        }

        return $errorMessage;
    }

    /**
     * Get the TypoScript frontend controller
     *
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}