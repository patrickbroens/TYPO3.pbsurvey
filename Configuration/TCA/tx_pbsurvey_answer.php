<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'question',
        //'readOnly' => true,
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-answer'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            item,
            item_option,
            item_option_row,
            open
        '
    ],
    'columns' => [
        'item' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.item',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pbsurvey_item',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'item_option' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.item_option',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pbsurvey_option',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'item_option_row' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.item_option_row',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pbsurvey_option_row',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'open' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.open',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                item,
                item_option_row,
                item_option,
                open
            '
        ]
    ]
];