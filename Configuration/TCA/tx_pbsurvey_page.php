<?php
return [
    'ctrl' => [
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'label' => 'title',
        'languageField' => 'sys_language_uid',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:title',
        'transOrigDiffSourceField' => 'l18n_diffsource',
        'transOrigPointerField' => 'l18n_parent',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-page'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            condition_groups,
            introduction,
            items,
            title
        '
    ],
    'columns' => [
        'condition_groups' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:field.condition_groups',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_pbsurvey_page_condition_group',
                'foreign_field' => 'parentid',
                'foreign_label' => 'name',
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'useSortable' => true,
                    'newRecordLinkAddTitle' => true,
                    'enabledControls' => [
                        'new' => false
                    ]
                ],
                'customControls' => [
                    \PatrickBroens\Pbsurvey\TCA\CustomControls\PageConditionGroup::class . '->render'
                ]
            ]
        ],
        'introduction' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:field.introduction',
            'config' => [
                'type' => 'text',
                'cols' => '80',
                'rows' => '15',
                'wizards' => [
                    'RTE' => [
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'type' => 'script',
                        'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.W.RTE',
                        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif',
                        'module' => [
                            'name' => 'wizard_rte'
                        ]
                    ]
                ]
            ]
        ],
        'items' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:field.items',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_pbsurvey_item',
                'foreign_field' => 'parentid',
                'foreign_label' => 'question',
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'useSortable' => true
                ]
            ]
        ],
        'title' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:field.title',
            'config' => [
                'type' => 'input',
                'size' => 30
            ]
        ],
        'sys_language_uid' => [
            'exclude' => false,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1
                    ], [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        0
                    ]
                ],
                'default' => 0,
                'showIconTable' => true
            ]
        ],
        'l18n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tx_pbsurvey_page',
                'foreign_table_where' => 'AND tx_pbsurvey_page.uid=###REC_FIELD_l18n_parent### AND tx_pbsurvey_page.sys_language_uid IN (-1,0)'
            ]
        ],
        'l18n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ]
    ],
    'types' => [
        1 => [
            'showitem' => '
                    sys_language_uid;;1,
                    title,
                    introduction;;;richtext:rte_transform[flag=rte_enabled|mode=ts];,
                 --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:tab.conditions,
                    condition_groups,
                 --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/Page.xlf:tab.items,
                    items
            '
        ]
    ],
    'palettes' => [
        1 => [
            'showitem' => '
                hidden,
                l18n_parent
            '
        ]
    ]
];