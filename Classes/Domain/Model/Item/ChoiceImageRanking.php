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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\FileReferenceTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\ImageConfigurationTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\NumberTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Traits\OptionRowsTrait;
use PatrickBroens\Pbsurvey\Domain\Model\Option;
use PatrickBroens\Pbsurvey\Domain\Model\OptionRow;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Item type 24: Choice - Image ranking
 */
class ChoiceImageRanking extends AbstractChoice
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

    /**
     * TRAIT: NumberTrait
     *
     * FIELDS:
     * $numberEnd
     * $numberStart
     */
    use NumberTrait;

    /**
     * TRAIT: OptionRowsTrait
     *
     * FIELDS:
     * $optionRows
     */
    use OptionRowsTrait;

    /**
     * The allowed condition operator groups
     *
     * @var array
     */
    protected static $allowedConditionOperatorGroups = [
        'equality',
        'containment',
        'provision'
    ];

    /**
     * Initialize this item
     */
    public function initialize()
    {
        $this->optionRows = [];

        foreach ($this->fileReferences as $fileReference) {
            /** @var OptionRow $optionRow */
            $optionRow = GeneralUtility::makeInstance(OptionRow::class);
            $optionRow->setUid($fileReference->getUid());

            foreach ($this->getRange(count($this->fileReferences), true) as $optionUid) {
                /** @var Option $option */
                $option = GeneralUtility::makeInstance(Option::class);
                $option->setUid($optionUid);
                $option->setValue($optionUid);

                $optionRow->addOption($option);
            }

            $this->addOptionRow($optionRow);
        }
    }
}