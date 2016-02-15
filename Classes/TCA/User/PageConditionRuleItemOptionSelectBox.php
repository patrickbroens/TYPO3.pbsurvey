<?php
namespace PatrickBroens\Pbsurvey\TCA\User;

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
use PatrickBroens\Pbsurvey\TCA\ItemControl;

/**
 * Fills the select box for answers in the condition rules in TCA ItemsProcFunc
 */
class PageConditionRuleItemOptionSelectBox extends ItemControl
{
    /**
     * The template root paths
     *
     * @var array
     */
    protected static $templateRootPaths = [
        'EXT:pbsurvey/Resources/Private/Template/Backend/TCA/PageConditionRule/User/'
    ];

    /**
     * Add the answers to select box
     *
     * This depends on the chosen question in the condition rule
     *
     * @param array $parameters Parameters from the record
     * @param \TYPO3\CMS\Backend\Form\Element\UserElement $formObject
     * @return string The user element markup
     */
    public function render($parameters, $formObject)
    {
        $content = '';

        $itemUid = (int)$parameters['row']['item'];
        $operator = (string)reset($parameters['row']['operator']);

        if ($itemUid && !empty($operator) && !in_array($operator, ['set', 'notset'])) {
            $item = $this->itemRepository->findByUid($itemUid, ['Option']);

            if ($item->isChoice() && $item->hasOptions()) {
                $content = $this->renderSelectBox($item, $parameters);
            }
        }

        return $content;
    }

    /**
     * Render the select box
     *
     * @param \PatrickBroens\Pbsurvey\Domain\Model\Item The item
     * @param array $parameters Parameters from the record
     * @return string The selectbox markup
     */
    protected function renderSelectBox($item, $parameters)
    {
        $this->view->setTemplate('OptionSelectBox');
        $this->view->assignMultiple([
            'options' => $item->getOptions(),
            'optionsPredefined' => $item->isPredefinedOptions(),
            'hasAdditional' => $item->isAdditionalAllowed(),
            'selectedValue' => (int)$parameters['itemFormElValue'],
            'name' => $parameters['itemFormElName'],
            'onChange' => implode('', $parameters['fieldChangeFunc'])
        ]);

        return $this->view->render();
    }
}