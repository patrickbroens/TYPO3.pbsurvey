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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedGroupRepository;

/**
 * Fills the select box for predefined answers in TCA ItemsProcFunc
 */
class AnswersPredefinedSelectBox
{
    /**
     * Add the predefined option groups to select box
     *
     * @param array $parameters Parameters from the record
     */
    public function getItems(&$parameters)
    {
        /** @var \PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedGroupRepository $optionPredefinedGroupRepository */
        $optionPredefinedGroupRepository = GeneralUtility::makeInstance(OptionPredefinedGroupRepository::class);

        $groups = $optionPredefinedGroupRepository->findAll();

        if (count($groups)) {
            /** @var \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefinedGroup $group */
            foreach ($groups as $group) {
                $parameters['items'][] = [$group->getName(), $group->getUid()];
            }
        }
    }
}