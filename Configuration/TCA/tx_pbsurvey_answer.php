<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'label' => 'question',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-answer'
        ]
    ],
    'interface' => [
        'showRecordFieldList' => '
            answer,
            col,
            hidden,
            question,
            result,
            row
        '
    ],
    'columns' => [
        'answer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.answer',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5
            ]
        ],
        'col' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.col',
            'config' => [
                'type' => 'input',
                'size' => 3,
                'eval' => 'int',
                'checkbox' => false
            ]
        ],
        'hidden' => [
            'l10n_mode' => 'mergeIfNotBlank',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 1
            ]
        ],
        'question' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.question',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pbsurvey_item',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'result' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.result',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_pbsurvey_results',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'row' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Answer.xlf:field.row',
            'config' => [
                'type' => 'input',
                'size' => 3,
                'eval' => 'int',
                'checkbox' => false
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                hidden,
                result,
                question,
                row,
                col,
                answer
            '
        ]
    ]
];