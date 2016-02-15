<?php
return [
    'ctrl' => [
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'name',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionGroup.xlf:title',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-page-condition-group'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            name,
            rules
        '
    ],
    'columns' => [
        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionGroup.xlf:field.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'required'
            ]
        ],
        'rules' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionGroup.xlf:field.rules',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_pbsurvey_page_condition_rule',
                'foreign_field' => 'parentid',
                'foreign_label' => 'label',
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                    'useSortable' => 1
                ]
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                name,
                rules
            '
        ]
    ]
];