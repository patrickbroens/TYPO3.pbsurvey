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

use TYPO3\CMS\Lang\LanguageService;

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
        $arguments = array_shift(func_get_args());

        $errorMessage = $this->getLanguageService()->sL(
            'LLL:EXT:pbsurvey/Resources/Private/Language/Frontend.xlf:' . $label
        );

        if (0 !== count($arguments)) {
            $errorMessage = vsprintf($errorMessage, $arguments);
        }

        return $errorMessage;
    }

    /**
     * Get language service, instantiate if not there, yet
     *
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}