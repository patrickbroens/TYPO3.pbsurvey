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

use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\TCA\Control;

/**
 * Fills the select box for answers in the condition rules in TCA ItemsProcFunc
 */
class PageConditionRuleItemOptionSelectBox extends Control
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
     * @param UserElement $formObject
     * @return string The user element markup
     */
    public function render($parameters, $formObject)
    {
        $content = '';

        $itemUid = (int)$parameters['row']['item'];
        $operator = (string)reset($parameters['row']['operator']);
        $storageFolder = (int)$parameters['row']['pid'];

        if ($itemUid && !empty($operator) && !in_array($operator, ['set', 'notset'])) {
            $this->setPageProvider($storageFolder);
            $item = $this->getItemByUid($itemUid);

            if (($item instanceof AbstractChoice) && $item->hasOptions()) {
                $content = $this->renderSelectBox($item, $parameters);
            }
        }

        return $content;
    }

    /**
     * Render the select box
     *
     * @param AbstractChoice $item The item
     * @param array $parameters Parameters from the record
     * @return string The selectbox markup
     */
    protected function renderSelectBox(AbstractChoice $item, $parameters)
    {
        $this->view->setTemplate('OptionSelectBox');
        $this->view->assignMultiple([
            'options' => $item->getOptions(),
            'hasAdditional' => $item->isAdditionalAllowed(),
            'selectedValue' => (int)$parameters['itemFormElValue'],
            'name' => $parameters['itemFormElName'],
            'onChange' => implode('', $parameters['fieldChangeFunc'])
        ]);

        return $this->view->render();
    }
}