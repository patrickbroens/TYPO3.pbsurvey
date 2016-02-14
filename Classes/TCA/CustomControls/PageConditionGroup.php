<?php
namespace PatrickBroens\Pbsurvey\TCA\CustomControls;

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
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use PatrickBroens\Pbsurvey\TCA\PageControl;

/**
 * Custom controls for page condition group inline form element
 */
class PageConditionGroup extends PageControl
{
    /**
     * The template root paths
     *
     * @var array
     */
    protected static $templateRootPaths = [
        'EXT:pbsurvey/Resources/Private/Template/Backend/TCA/PageConditionGroup/CustomControls/'
    ];

    /**
     * Render custom controls
     *
     * @param array $parameters The parameters
     * @param \TYPO3\CMS\Backend\Form\Container\InlineControlContainer $inlineControlContainer The inline control container
     * @return string
     */
    public function render($parameters, $inlineControlContainer)
    {
        $content = '';

        $currentPageUid = (int)$parameters['row']['uid'];

        if (!$currentPageUid || strstr($currentPageUid, 'NEW')) {
            $content = $this->renderSaveWarning();
        } else {
            $pagesBeforeCurrentPage = $this->pageRepository->findBeforePage($currentPageUid, ['Item']);

            if (count($pagesBeforeCurrentPage)) {
                if ($this->hasQuestions($pagesBeforeCurrentPage)) {
                    $content = $this->renderNewButton($parameters);
                } else {
                    $content = $this->renderNoQuestionsWarning();
                }
            } else {
                $content = $this->renderNoPagesWarning();
            }
        }

        return $content;
    }

    /**
     * Render the button for new page condition groups
     *
     * @param array $parameters The parameters
     * @return string Markup for the button
     */
    protected function renderNewButton($parameters)
    {
        $linkStyle = '';

        $title = $this->getLanguageService()->sL('LLL:EXT:lang/locallang_core.xlf:cm.createnew', true);
        if (!empty($parameters['config']['inline']['inlineNewButtonStyle'])) {
            $linkStyle = $parameters['config']['inline']['inlineNewButtonStyle'];
        }
        if (!empty($parameters['config']['appearance']['newRecordLinkAddTitle'])) {
            $title = sprintf(
                $this->getLanguageService()->sL('LLL:EXT:lang/locallang_core.xlf:cm.createnew.link', true),
                $this->getLanguageService()->sL(
                    $GLOBALS['TCA'][$parameters['config']['foreign_table']]['ctrl']['title'], true
                )
            );
        } elseif (
            isset($parameters['config']['appearance']['newRecordLinkTitle'])
            && $parameters['config']['appearance']['newRecordLinkTitle'] !== ''
        ) {
            $title = $this->getLanguageService()->sL($parameters['config']['appearance']['newRecordLinkTitle'], true);
        }

        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $icon = $iconFactory->getIcon('actions-document-new', Icon::SIZE_SMALL)->render();

        $this->view->setTemplate('NewButton');

        $this->view->assignMultiple([
            'className' => 'typo3-newRecordLink',
            'title' => $title,
            'link' => [
                'body' => $icon . $title,
                'className' => 'btn btn-default inlineNewButton ' . md5($parameters['nameObject']),
                'onClick' => 'return inline.createNewRecord('
                    . GeneralUtility::quoteJSvalue(
                        $parameters['nameObject'] . '-' . $parameters['config']['foreign_table']
                    ) . ')',
                'style' => $linkStyle
            ]
        ]);

        return $this->view->render();
    }

    /**
     * Render the warning markup when there are no questions in front of this page
     *
     * @return string The warning markup
     */
    protected function renderNoQuestionsWarning()
    {
        $this->view->setTemplate('NoQuestionsWarning');

        return $this->view->render();
    }

    /**
     * Render the warning markup when there are no pages in front of this page
     *
     * @return string The warning markup
     */
    protected function renderNoPagesWarning()
    {
        $this->view->setTemplate('NoPagesWarning');

        return $this->view->render();
    }
}