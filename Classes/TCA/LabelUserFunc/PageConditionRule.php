<?php
namespace PatrickBroens\Pbsurvey\TCA\LabelUserFunc;

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

use PatrickBroens\Pbsurvey\TCA\ItemControl;

/**
 * Create label for page condition rules
 */
class PageConditionRule extends ItemControl
{
    /**
     * The operators
     *
     * @var array
     */
    protected static $operators = [
        'eq' => 'equal',
        'ne' => 'notEqual',
        'ss' => 'contains',
        'ns' => 'notContains',
        'gt' => 'greater',
        'ge' => 'greaterEqual',
        'lt' => 'less',
        'le' => 'lessEqual',
        'set' => 'set',
        'notset' => 'notSet'
    ];

    /**
     * The template root paths
     *
     * @var array
     */
    protected static $templateRootPaths = [
        'EXT:pbsurvey/Resources/Private/Template/Backend/TCA/PageConditionRule/LabelUserFunc/'
    ];

    /**
     * Get the label for a page condition rule
     *
     * Depending on the settings it will show an error if conditions are not met
     *
     * @param array $parameters The parameters
     * @param null $null Null parameter
     * @return string
     */
    public function render(&$parameters, $null)
    {
        $question = $operator = $optionValue = $additionalValue = '';

        $itemUid = $parameters['row']['item'];
        $operatorId = reset($parameters['row']['operator']);
        $optionUid = $parameters['row']['item_option'];
        $additionalText = $parameters['row']['item_option_additional'];

        $item = $this->itemRepository->findByUid($itemUid, ['Option']);

        if ($item && $item->isQuestion()) {
            $question = $item->getQuestion();

            if ($operatorId !== '') {
                $operator = static::$operators[$operatorId];

                if (!in_array($operatorId, ['set', 'notset'])) {
                    if ($item->hasOption($optionUid)) {
                        $option = $item->getOptionByUid($optionUid);
                        $optionValue = $option->getValue();

                    } elseif (empty($item->isAdditionalAllowed())) {
                        $additionalValue = $additionalText;
                    }
                }
            }
        }

        $optionSelected = !empty($optionValue) || !empty($additionalValue);
        $optionNeeded = !in_array($operatorId, ['set', 'notset']);

        $isFilled = (
            !empty($question)
            && !empty($operator)
            && (
                (
                    $optionNeeded
                    && $optionSelected
                )
                || !$optionNeeded
            )
        );

        $parameters['title'] = $this->renderLabel($isFilled, $question, $operator, $optionNeeded, $optionValue, $additionalValue);
    }

    /**
     * Render the label
     *
     * @param bool $isFilled true if rule form has been filled completely
     * @param string $question The question
     * @param string $operator The operator
     * @param bool $optionNeeded true if option is needed
     * @param string $option The option
     * @param string $additional Additional value
     * @return string The label markup
     */
    protected function renderLabel($isFilled, $question, $operator, $optionNeeded, $option, $additional)
    {
        $this->view->setTemplate('Label');
        $this->view->assignMultiple([
            'isFilled' => $isFilled,
            'question' => $question,
            'operator' => $operator,
            'optionNeeded' => $optionNeeded,
            'option' => $option,
            'additional' => $additional
        ]);

        return $this->view->render();
    }
}