<?php
return [
    'ctrl' => [
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'label',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionPredefined.xlf:title',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-option-predefined'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            label
        '
    ],
    'columns' => [
        'label' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/OptionPredefined.xlf:field.label',
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