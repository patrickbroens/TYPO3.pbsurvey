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
use TYPO3\CMS\Lang\LanguageService;
use PatrickBroens\Pbsurvey\TCA\ItemControl;

/**
 * Fills the select box for operators in the condition rules in TCA ItemsProcFunc
 */
class PageConditionRuleOperatorSelectBox extends ItemControl
{
    /**
     * The operator groups
     *
     * @var array
     */
    protected static $operatorGroups = [
        'equality' => [
            'eq' => 'equal',
            'ne' => 'notEqual'
        ],
        'containment' => [
            'ss' => 'contains',
            'ns' => 'notContains'
        ],
        'mathematical' => [
            'gt' => 'greater',
            'ge' => 'greaterEqual',
            'lt' => 'less',
            'le' => 'lessEqual'
        ],
        'provision' => [
            'set' => 'set',
            'notset' => 'notSet'
        ]
    ];

    /**
     * Add the operators to select box
     *
     * This depends on the chosen question type in the condition rule
     *
     * @param array $parameters Parameters from the record
     */
    public function getItems(&$parameters)
    {
        $itemUid = (int)$parameters['row']['item'];
        $selectedOperator = (string)$parameters['row']['operator'];

        if ($itemUid) {
            $operators = $this->getOperatorsFromItem($itemUid);

            if (empty($selectedOperator)) {
                $parameters['items'][] = [
                    $this->getLanguageService()->sL(
                        'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.operator.empty'
                    ),
                    ''
                ];
            }

            foreach ($operators as $key => $value) {
                $parameters['items'][] = [$value, $key];
            }
        }
    }

    /**
     * Get all the operators provided by the item
     *
     * The item returns the groups which are converted to the operators itself
     *
     * @param int $itemUid The item uid
     * @return array The operators
     */
    protected function getOperatorsFromItem($itemUid)
    {
        $operators = [];

        $item = $this->itemRepository->findByUid($itemUid);

        if ($item) {
            $itemOperatorGroups = $item->getAllowedConditionOperatorGroups();

            foreach ($itemOperatorGroups as $itemOperatorGroupName) {
                foreach (static::$operatorGroups[$itemOperatorGroupName] as $key => $value) {
                    $operators[$key] = $this->getLanguageService()->sL(
                        'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.operator.' . $value
                    );
                }

            }
        }

        return $operators;
    }
}