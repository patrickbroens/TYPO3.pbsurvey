<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results',
        'label' => 'uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            hidden,
            user,
            ip,
            finished,
            begintstamp,
            endtstamp,
            language_uid,
            answers
        '
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => '0',
            ]
        ],
        'user' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ]
        ],
        'ip' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.ip',
            'config' => [
                'type' => 'input',
                'size' => '15',
                'max' => '15',
            ]
        ],
        'finished' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.finished',
            'config' => [
                'type' => 'check',
                'default' => '0',
            ]
        ],
        'begintstamp' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.begintstamp',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'datetime',
            ]
        ],
        'endtstamp' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.endtstamp',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'datetime',
            ]
        ],
        'language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.language',
            'config' => [
                'type' => 'input',
                'size' => '15',
                'max' => '15',
            ]
        ],
        'history' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:pbsurvey/lang/locallang_db.xml:tx_pbsurvey_results.history',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
    ],
    'types' => [
        1 => [
            'showitem' => '
                hidden;;1,
                user,
                ip,
                finished,
                begintstamp,
                endtstamp,
                language_uid,
                answers,
                history
            '
        ]
    ]
];