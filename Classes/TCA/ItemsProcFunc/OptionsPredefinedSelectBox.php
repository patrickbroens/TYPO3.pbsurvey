<?php
namespace PatrickBroens\Pbsurvey\TCA\ItemsProcFunc;

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

use PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedGroupRepository;

/**
 * Fills the select box for predefined options in TCA ItemsProcFunc
 */
class OptionsPredefinedSelectBox
{
    /**
     * Add the predefined option groups to select box
     *
     * @param array $parameters Parameters from the record
     */
    public function getItems(&$parameters)
    {
        /** @var OptionPredefinedGroupRepository $optionPredefinedGroupRepository */
        $optionPredefinedGroupRepository = GeneralUtility::makeInstance(OptionPredefinedGroupRepository::class);

        $groups = $optionPredefinedGroupRepository->findAll();

        if (count($groups)) {
            /** @var OptionPredefinedGroup $group */
            foreach ($groups as $group) {
                $parameters['items'][] = [$group->getName(), $group->getUid()];
            }
        }
    }
}