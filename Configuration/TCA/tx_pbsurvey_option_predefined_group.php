<?php
return [
    'ctrl' => [
        'default_sortby' => 'name ASC',
        'delete' => 'deleted',
        'label' => 'name',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionPredefinedGroup.xlf:title',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-option-predefined-group'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            name,
            options
        '
    ],
    'columns' => [
        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionPredefinedGroup.xlf:field.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'required'
            ]
        ],
        'options' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionPredefinedGroup.xlf:field.options',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_pbsurvey_option_predefined',
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
        '1' => [
            'showitem' => '
                name,
                options
            '
        ]
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ]
    ]
];