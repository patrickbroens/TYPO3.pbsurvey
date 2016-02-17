<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'name',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionRow.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_option_row'
        ],

    ],
    'interface' => [
        'showRecordFieldList' => '
            name
        '
    ],
    'columns' => [
        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionRow.xlf:field.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'required'
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                name
            '
        ]
    ]
];