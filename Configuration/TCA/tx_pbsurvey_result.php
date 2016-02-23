<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'default_sortby' => 'uid ASC',
        'delete' => 'deleted',
        'label' => 'uid',
        //'readOnly' => true,
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-tx_pbsurvey_result'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            answers,
            fe_user,
            finished,
            ip,
            language_uid,
            timestamp_begin,
            timestamp_end
        '
    ],
    'columns' => [
        'answers' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.answers',
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
        'fe_user' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'finished' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.finished',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'ip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.ip',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'max' => 15
            ]
        ],
        'language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.language_uid',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'sys_language',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'timestamp_begin' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.timestamp_begin',
            'config' => [
                'type' => 'input',
                'size' => 8,
                'max' => 20,
                'eval' => 'datetime'
            ]
        ],
        'timestamp_end' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:field.timestamp_end',
            'config' => [
                'type' => 'input',
                'size' => 8,
                'max' => 20,
                'eval' => 'datetime'
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                    fe_user,
                    ip,
                    finished,
                    --palette--;;1,
                    language_uid,
                --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Result.xlf:tab.answers,
                    answers
            '
        ]
    ],
    'palettes' => [
        1 => [
            'showitem' => '
                timestamp_begin,
                timestamp_end
            '
        ]
    ]
];