<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'label',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf:title',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-option'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            checked,
            points,
            value
        '
    ],
    'columns' => [
        'checked' => [
            'exclude' => true,
              'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf:field.checked',
              'config' => [
                  'type' => 'check'
              ]
        ],
        'label' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf:field.label',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'required'
            ]
        ],
        'points' => [
            'exclude' => true,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf:field.points',
            'config' => [
                'type' => 'input',
                'size' => 8,
                'max' => 20,
                'eval' => 'int'
            ]
        ],
        'value' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Option.xlf:field.value',
            'config' => [
                'type' => 'input',
                'size' => 40
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                --palette--;;1
            '
        ]
    ],
    'palettes' => [
        1 => [
            'showitem' => '
                label,
                points,
                checked
            '
        ]
    ]
];