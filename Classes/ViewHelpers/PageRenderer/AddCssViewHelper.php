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
 * Add a CSS file to the page renderer
 */
class AddCssViewHelper extends AbstractViewHelper
{
    /**
     * Adds CSS file
     *
     * @param string $file
     * @param string $rel
     * @param string $media
     * @param string $title
     * @param bool $compress
     * @param bool $forceOnTop
     * @param string $allWrap
     * @param bool $excludeFromConcatenation
     * @param string $splitChar The char used to split the allWrap value, default is "|"
     * @return void
     */
    public function render(
        $file,
        $rel = 'stylesheet',
        $media = 'all',
        $title = '',
        $compress = true,
        $forceOnTop = false,
        $allWrap = '',
        $excludeFromConcatenation = false,
        $splitChar = '|'
    )
    {
        $this->getPageRenderer()->addCssFile(
            $file,
            $rel,
            $media,
            $title,
            $compress,
            $forceOnTop,
            $allWrap,
            $excludeFromConcatenation,
            $splitChar
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
