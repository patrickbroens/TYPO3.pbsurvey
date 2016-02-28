<?php
namespace PatrickBroens\Pbsurvey\ViewHelpers\PageRenderer;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Add a javascript footer library to the page renderer
 */
class AddJsFooterLibraryViewHelper extends AbstractViewHelper
{
    /**
     * Adds JS file to footer
     *
     * @param string $name Arbitrary identifier
     * @param string $file File name
     * @param string $type Content Type
     * @param bool $compress Flag if library should be compressed
     * @param bool $forceOnTop Flag if added library should be inserted at begin of this block
     * @param string $allWrap
     * @param bool $excludeFromConcatenation
     * @param string $splitChar The char used to split the allWrap value, default is "|"
     * @param bool $async Flag if property 'async="async"' should be added to JavaScript tags
     * @param string $integrity Subresource Integrity (SRI)
     * @return void
     */
    public function render(
        $name,
        $file,
        $type = 'text/javascript',
        $compress = false,
        $forceOnTop = false,
        $allWrap = '',
        $excludeFromConcatenation = false,
        $splitChar = '|',
        $async = false,
        $integrity = ''
    )
    {
        $this->getPageRenderer()->addJsFooterLibrary(
            $name,
            $file,
            $type,
            $compress,
            $forceOnTop,
            $allWrap,
            $excludeFromConcatenation,
            $splitChar,
            $async,
            $integrity
        );
    }

    /**
     * Returns current PageRenderer
     *
     * @return PageRenderer
     */
    protected function getPageRenderer()
    {
        return GeneralUtility::makeInstance(PageRenderer::class);
    }
}