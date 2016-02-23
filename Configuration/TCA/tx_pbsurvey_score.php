<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'default_sortby' => 'score ASC',
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'score',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Score.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_score'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            page,
            score
        '
    ],
    'columns' => [
        'page' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Score.xlf:field.page',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 1,
                'show_thumbs' => true
            ]
        ],
        'score' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Score.xlf:field.score',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'required, int'
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                score,
                page
            '
        ]
    ]
];