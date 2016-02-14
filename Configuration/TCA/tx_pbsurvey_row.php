<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'label' => 'name',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Row.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_row'
        ],

    ],
    'interface' => [
        'showRecordFieldList' => '
            name
        '
    ],
    'types' => [
        '1' => [
            'showitem' => '
                name
            '
        ]
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ]
    ],
    'columns' => [
        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Row.xlf:field.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'required'
            ]
        ]
    ]
];