<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item;

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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractPresentation;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\FileReferenceTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\ImageConfigurationTrait;

/**
 * Item type 20: Presentation - Image
 */
class PresentationImage extends AbstractPresentation
{
    /**
     * TRAIT: FileReferenceTrait
     *
     * FIELDS:
     * $fileReferences
     */
    use FileReferenceTrait;

    /**
     * TRAIT: ImageConfigurationTrait
     *
     * FIELDS:
     * $imageAlignment
     * $imageHeight
     * $imageWidth
     */
    use ImageConfigurationTrait;
}