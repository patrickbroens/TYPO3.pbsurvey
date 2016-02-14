<?php
namespace PatrickBroens\Pbsurvey\Updates;

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

use TYPO3\CMS\Install\Updates\AbstractUpdate;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Upgrade the extension 'pbsurvey'
 */
class Upgrade extends AbstractUpdate
{
    /**
     * @var string
     */
    protected $title = 'Upgrade the extension "pbsurvey"';

    /**
     * Checks if an update is needed
     *
     * @param string &$description The description for the update
     * @return bool Whether an update is needed (TRUE) or not (FALSE)
     */
    public function checkForUpdate(&$description)
    {
        $contentElementCount = $this->getDatabaseConnection()->exec_SELECTcountRows(
            'uid',
            'tt_content',
            'CType=\'list\' AND list_type=\'pbsurvey\' AND deleted = 0'
        );

        if (
            $this->isWizardDone() || $contentElementCount === 0
        ) {
            return false;
        }

        $description = 'The extension "pbsurvey" has been changed to "survey". This new extension uses regular ' .
            'fields in the tt_content table. Before this was a FlexForm.<br /><br />' .
            'This update wizard migrates these FlexForms to regular database fields ' .
            'and updates the CType of this extension.';

        return true;
    }

    /**
     * Performs the database update
     *
     * @param array &$databaseQueries Queries done in this update
     * @param mixed &$customMessages Custom messages
     * @return bool
     */
    public function performUpdate(array &$databaseQueries, &$customMessages)
    {
        $databaseConnection = $this->getDatabaseConnection();

        $databaseResult = $databaseConnection->exec_SELECTquery(
            'uid, pi_flexform',
            'tt_content',
            'CType=\'list\' AND list_type=\'dreep_ep\' AND pi_flexform IS NOT NULL AND deleted = 0'
        );

        while ($tableRecord = $databaseConnection->sql_fetch_assoc($databaseResult)) {
            $flexForm = $this->initializeFlexForm($tableRecord['pi_flexform']);

            if (is_array($flexForm)) {
                $fields = $this->mapFieldsFromFlexForm($flexForm);

                // Set CType to new extension key
                $fields['CType'] = 'tueep_employee';

                // Set the list_type to empty
                $fields['list_type'] = '';

                // Set pi_flexform to NULL
                $fields['pi_flexform'] = null;

                $databaseConnection->exec_UPDATEquery(
                    'tt_content',
                    'uid=' . (int)$tableRecord['uid'],
                    $fields
                );

                $databaseQueries[] = $databaseConnection->debug_lastBuiltQuery;
            }
        }

        $databaseConnection->sql_free_result($databaseResult);

        $this->markWizardAsDone();

        return true;
    }

    /**
     * Map the old FlexForm values to the new database fields
     * and fill them with the proper data
     *
     * @param array $flexForm The content of the FlexForm
     * @return array The fields which need to be updated in the tt_content table
     */
    protected function mapFieldsFromFlexForm($flexForm)
    {
        $fields = [];

        $mapping = [
            'tueep_switchable_controller_actions' => [
                'sheet' => 'sDEF',
                'fieldName' => 'switchableControllerActions',
                'default' => '',
                'values' => [
                    'Employee->listByName' => 'Employee->listByName',
                    'Employee->listByJob' => 'Employee->listByJob',
                    'Employee->listByDepartment' => 'Employee->listByDepartment',
                    'Professor->index' => 'Professor->index',
                    'Expert->index' => 'Expert->index;Expert->search',
                    'Search->index' => 'Search->index;Search->search',
                    'Publication->group' => 'Publication->group',
                    'Owis->index' => 'Owis->index',
                    'Employee->detailUncached' => ''
                ]
            ],
            'tueep_list_type' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.employeelistType',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_workplace' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.workplace',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_department' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.department',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_research_program' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.program',
                'default' => '',
                'values' => 'passthrough'
            ],
            'tueep_publication_type' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.publicationType',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_academic_staff_only' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.academicStaffOnly',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_owis_faculty' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.OWISFaculteitId',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_owis_capacity_group' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.OWISCapaciteitsgroepId',
                'default' => 0,
                'values' => 'passthrough'
            ],
            'tueep_owis_section' => [
                'sheet' => 'sDEF',
                'fieldName' => 'settings.OWISSectionId',
                'default' => 0,
                'values' => 'passthrough'
            ]
        ];

        foreach ($mapping as $fieldName => $configuration) {
            $flexFormValue = $this->getFlexFormValue($flexForm, $configuration['fieldName'], $configuration['sheet']);

            if ($flexFormValue !== '') {
                if ($configuration['values'] === 'passthrough') {
                    $fields[$fieldName] = $flexFormValue;
                } elseif (is_array($configuration['values'])) {
                    $fields[$fieldName] = $configuration['values'][$flexFormValue];
                }
            } else {
                $fields[$fieldName] = $configuration['default'];
            }
        }

        return $fields;
    }

    /**
     * Convert the XML of the FlexForm to an array
     *
     * @param string|NULL $flexFormXml The XML of the FlexForm
     * @return array|NULL Converted XML to array
     */
    protected function initializeFlexForm($flexFormXml)
    {
        $flexForm = null;

        if ($flexFormXml) {
            $flexForm = GeneralUtility::xml2array($flexFormXml);
            if (!is_array($flexForm)) {
                $flexForm = null;
            }
        }

        return $flexForm;
    }

    /**
     * @param array $flexForm The content of the FlexForm
     * @param string $fieldName The field name to get the value for
     * @param string $sheet The sheet on which this value is located
     * @return string The value
     */
    protected function getFlexFormValue(array $flexForm, $fieldName, $sheet = 'sDEF')
    {
        return $flexForm['data'][$sheet]['lDEF'][$fieldName]['vDEF'];
    }
}
