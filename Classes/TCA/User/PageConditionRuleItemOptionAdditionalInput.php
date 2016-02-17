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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractChoice;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractOpenEnded;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\TCA\ItemControl;

/**
 * Make an input field for an additional answer in the condition rules in TCA
 */
class PageConditionRuleItemOptionAdditionalInput extends ItemControl
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
     * Add the additional answer field
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
            $item = $this->itemRepository->findByUid($itemUid);

            if (
                ($item instanceof AbstractOpenEnded)
                || (
                    ($item instanceof AbstractChoice)
                    && $item->isAdditionalAllowed()
                )
            ) {
                $content = $this->renderInput($parameters);
            }
        }

        return $content;
    }

    /**
     * Render the input
     *
     * @param array $parameters Parameters from the record
     * @return string The selectbox markup
     */
    protected function renderInput($parameters)
    {
        $this->view->setTemplate('OptionAdditionalInput');
        $this->view->assignMultiple([
            'value' => (string)$parameters['itemFormElValue'],
            'name' => $parameters['itemFormElName'],
            'onChange' => implode('', $parameters['fieldChangeFunc'])
        ]);

        return $this->view->render();
    }
}