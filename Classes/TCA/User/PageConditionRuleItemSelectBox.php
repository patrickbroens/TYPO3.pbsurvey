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

use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Survey\PageConditionGroupProvider;
use PatrickBroens\Pbsurvey\TCA\PageControl;
use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Fills the select box for questions in the condition rules in TCA ItemsProcFunc
 */
class PageConditionRuleItemSelectBox extends PageControl
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
     * Show a select box for condition rules
     *
     * This can only be questions which are in front of the page
     *
     * @param array $parameters Parameters from the record
     * @param UserElement $formObject
     * @return string The user element markup
     */
    public function render($parameters, $formObject)
    {
        $content = '';

        $groupUid = (int)$parameters['row']['parentid'];
        $storageFolder = (int)$parameters['row']['pid'];

        if (!$groupUid || strstr($groupUid, 'NEW')) {
            $content = $this->renderSaveWarning();
        } else {
            $this->setPageProvider($storageFolder);

            /** @var PageConditionGroupProvider $pageConditionGroupProvider */
            $pageConditionGroupProvider = GeneralUtility::makeInstance(PageConditionGroupProvider::class);
            $currentGroup = $pageConditionGroupProvider->findByUid($groupUid);
            $parentPage = $currentGroup->getParentid();

            $pagesBeforeCurrentPage = $this->pageProvider->findBeforePage($parentPage);

            if ($pagesBeforeCurrentPage) {
                if ($this->hasQuestions($pagesBeforeCurrentPage)) {
                    $content = $this->renderSelectBox($pagesBeforeCurrentPage, $parameters);
                }
            }
        }

        return $content;
    }

    /**
     * Render the select box
     *
     * @param Page[] The pages
     * @param array $parameters Parameters from the record
     * @return string The selectbox markup
     */
    protected function renderSelectBox($pagesBeforeCurrentPage, $parameters)
    {
        $this->view->setTemplate('ItemSelectBox');
        $this->view->assignMultiple([
            'pages' => $pagesBeforeCurrentPage,
            'selectedValue' => (int)$parameters['itemFormElValue'],
            'name' => $parameters['itemFormElName'],
            'onChange' => implode('', $parameters['fieldChangeFunc'])
        ]);

        return $this->view->render();
    }
}