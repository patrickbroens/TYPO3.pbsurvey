<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'label',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionRow.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_option_row'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            label
        '
    ],
    'columns' => [
        'label' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionRow.xlf:field.label',
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
                label
            '
        ]
    ]
];