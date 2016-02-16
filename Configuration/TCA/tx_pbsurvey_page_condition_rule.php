<?php
return [
    'ctrl' => [
        'delete' => 'deleted',
        'hideTable' => true,
        'label' => 'item',
        'formattedLabel_userFunc' => \PatrickBroens\Pbsurvey\TCA\LabelUserFunc\PageConditionRule::class . '->render',
        'requestUpdate' => 'item, operator',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:title',
        'typeicon_classes' => [
            'default' => 'mimetypes-x-pbsurvey-page-condition-rule'
        ],
    ],
    'interface' => [
        'showRecordFieldList' => '
            item,
            item_option,
            item_option_additional,
            operator
        '
    ],
    'columns' => [
        'item' => [
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.item',
            'config' => [
                'type' => 'user',
                'userFunc' => \PatrickBroens\Pbsurvey\TCA\User\PageConditionRuleItemSelectBox::class . '->render'
            ]
        ],
        'item_option' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.item_option',
            'displayCond' => [
                'AND' => [
                    'REC:NEW:false',
                    'FIELD:item:REQ:true',
                    'FIELD:operator:REQ:true'
                ]
            ],
            'config' => [
                'type' => 'user',
                'userFunc' => \PatrickBroens\Pbsurvey\TCA\User\PageConditionRuleItemOptionSelectBox::class . '->render'
            ]
        ],
        'item_option_additional' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.item_option_additional',
            'displayCond' => [
                'AND' => [
                    'REC:NEW:false',
                    'FIELD:item:REQ:true'
                ]
            ],
            'config' => [
                'type' => 'user',
                'userFunc' => \PatrickBroens\Pbsurvey\TCA\User\PageConditionRuleItemOptionAdditionalInput::class . '->render'
            ]
        ],
        'operator' => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude' => false,
            'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/PageConditionRule.xlf:field.operator',
            'displayCond' => [
                'AND' => [
                    'REC:NEW:false',
                    'FIELD:item:REQ:true'
                ]
            ],
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'itemsProcFunc' => \PatrickBroens\Pbsurvey\TCA\ItemsProcFunc\PageConditionRuleOperatorSelectBox::class . '->getItems',
                'size' => 1,
                'maxitems' => 1
            ]
        ],
    ],
    'types' => [
        1 => [
            'showitem' => '
                item;;1
            '
        ]
    ],
    'palettes' => [
        1 => [
            'showitem' => '
                operator,
                item_option,
                item_option_additional
            '
        ]
    ]
];