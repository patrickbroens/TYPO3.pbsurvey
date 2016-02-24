<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'label' => 'uid',
        //'readOnly' => true,
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Stage.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_stage'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            answers,
            page
        '
    ],
    'columns' => [
        'answers' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Stage.xlf:field.answers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_pbsurvey_answer',
                'foreign_field' => 'parentid',
                'foreign_label' => 'item',
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'useSortable' => true
                ]
            ]
        ],
        'page' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Stage.xlf:field.page',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                    page,
                --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Stage.xlf:tab.answers,
                    answers
            '
        ]
    ],
    'palettes' => [
        1 => [
            'showitem' => ''
        ]
    ]
];