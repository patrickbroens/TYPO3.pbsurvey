<?php
namespace PatrickBroens\Pbsurvey\Wizard;

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
use PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedRepository;
use PatrickBroens\Pbsurvey\Domain\Repository\OptionRepository;
use PatrickBroens\Pbsurvey\Domain\Repository\ItemRepository;

/**
 * The option wizard
 */
class OptionWizard
{
    /**
     * The option repository
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Repository\OptionRepository
     */
    protected $optionRepository;

    /**
     * The item repository
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Repository\ItemRepository
     */
    protected $itemRepository;

    /**
     * The predefined options repository
     *
     * @var \PatrickBroens\Pbsurvey\Domain\Repository\OptionPredefinedRepository
     */
    protected $optionPredefinedRepository;

    /**
     * Constructor
     *
     * Set the repositories
     */
    public function __construct()
    {
        $this->optionRepository = GeneralUtility::makeInstance(OptionRepository::class);
        $this->itemRepository = GeneralUtility::makeInstance(ItemRepository::class);
        $this->optionPredefinedRepository = GeneralUtility::makeInstance(OptionPredefinedRepository::class);
    }

    /**
     * Add the possible answers to an item
     *
     * @param int $uid The uid of the item
     * @param int $predefinedGroup The chosen predefined group
     */
    public function process($uid, $predefinedGroup)
    {
        $this->optionRepository->deleteByParentId($uid);

        if ($predefinedGroup < 0) {
            $amountOfOptions = $this->setPredefinedOptionsFromConfiguration($predefinedGroup, $uid);
        } else {
            $amountOfOptions = $this->setPredefinedOptionsFromRecords($predefinedGroup, $uid);
        }

        $this->itemRepository->updateFields(
            $uid,
            [
                'options' => $amountOfOptions,
                'options_predefined_group' => 0
            ]
        );
    }

    /**
     * Add predefined options from configuration
     *
     * @param int $predefinedGroup The chosen predefined group
     * @param int $parentId The parent id of the options
     * @return int The amount of answers added
     */
    protected function setPredefinedOptionsFromConfiguration($predefinedGroup, $parentId)
    {
        $optionGroupsOptionsAmount = [
            -1 => 5,
            -2 => 5,
            -3 => 5,
            -4 => 5,
            -5 => 5,
            -6 => 5,
            -7 => 5,
            -8 => 5,
            -9 => 5,
            -10 => 5,
            -11 => 5,
            -12 => 5,
            -13 => 5,
            -14 => 5,
            -15 => 5,
            -16 => 5,
            -17 => 3
        ];

        $languageFile = 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf';

        $optionAmount = $optionGroupsOptionsAmount[$predefinedGroup];

        for ($count = 1; $count <= $optionAmount; $count++) {
            $this->optionRepository->insert(
                $parentId,
                $this->getLanguageService()->sL($languageFile . ':predefined.' . $predefinedGroup . '.' . $count),
                $count
            );
        }

        return $optionAmount;
    }

    /**
     * Add predefined options from records
     *
     * @param int $predefinedGroup The chosen predefined group
     * @param int $parentId The parent id of the options
     * @return int The amount of answers added
     */
    protected function setPredefinedOptionsFromRecords($predefinedGroup, $parentId)
    {
        $predefinedOptions = $this->optionPredefinedRepository->findByPredefinedOptionGroup($predefinedGroup);

        $optionAmount = count($predefinedOptions);

        /** @var $predefinedOption \PatrickBroens\Pbsurvey\Domain\Model\OptionPredefined */
        $sorting = 1;
        foreach($predefinedOptions as $predefinedOption) {
            $this->optionRepository->insert(
                $parentId,
                $predefinedOption->getLabel(),
                $sorting
            );
            $sorting++;
        }

        return $optionAmount;
    }

    /**
     * Get the language service
     *
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}