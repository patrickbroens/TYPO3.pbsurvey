<?php
defined('TYPO3_MODE') or die();

// Extra fields for the tt_content table
$extraTtContentColumns = [
    'pbsurvey_access_level' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.accessLevel',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.accessLevel.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.accessLevel.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.accessLevel.2',
                    2
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.accessLevel.3',
                    3
                ]
            ]
        ]
    ],
    'pbsurvey_anonymous_mode' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.anonymousMode',
        'displayCond' => 'FIELD:pbsurvey_access_level:IN:1,3',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.anonymousMode.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.anonymousMode.1',
                    1
                ]
            ],
            'default' => 1
        ]
    ],
    'pbsurvey_cancel_page' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.cancelPage',
        'config' => [
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'pages',
            'size' => 1,
            'maxitems' => 1,
            'minitems' => 0,
            'show_thumbs' => 1
        ]
    ],
    'pbsurvey_captcha' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.captcha',
        'config' => [
            'type' => 'check'
        ]
    ],
    'pbsurvey_completion_action' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionAction',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionAction.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionAction.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionAction.2',
                    2
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionAction.3',
                    3
                ]
            ],
            'default' => 1
        ]
    ],
    'pbsurvey_completion_close_button' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionCloseButton',
        'config' => [
            'type' => 'check'
        ]
    ],
    'pbsurvey_completion_continue_button' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionContinueButton',
        'config' => [
            'type' => 'check'
        ]
    ],
    'pbsurvey_completion_page' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.completionPage',
        'config' => [
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'pages',
            'size' => 1,
            'maxitems' => 1,
            'minitems' => 0,
            'show_thumbs' => 1
        ]
    ],
    'pbsurvey_cookie_lifetime' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.cookieLifetime',
        'displayCond' => 'FIELD:pbsurvey_access_level:IN:1,3',
        'config' => [
            'type' => 'input',
            'size' => 4,
            'default' => 30
        ]
    ],
    'pbsurvey_days_for_update' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.daysForUpdate',
        'config' => [
            'type' => 'input',
            'size' => 8,
            'max' => 20,
            'eval' => 'int',
            'default' => 30
        ]
    ],
    'pbsurvey_entering_stage' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.enteringStage',
        'displayCond' => 'FIELD:pbsurvey_access_level:IN:1,3',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.enteringStage.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.enteringStage.1',
                    1
                ]
            ]
        ]
    ],
    'pbsurvey_first_column_width' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.firstColumnWidth',
        'config' => [
            'type' => 'input',
            'size' => 3,
            'eval' => 'trim, int',
            'range' => [
                'lower' => 0,
                'upper' => 100
            ],
            'default' => 20,
            'wizards' => [
                'slider' => [
                    'type' => 'slider',
                    'step' => 1,
                ]
            ]
        ]
    ],
    'pbsurvey_mail_body' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailBody',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:=:2',
        'config' => [
            'type' => 'input',
            'size' => 50
        ]
    ],
    'pbsurvey_mail_cc' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailCc',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:!=:0',
        'config' => [
            'type' => 'input',
            'size' => 25
        ]
    ],
    'pbsurvey_mail_from_address' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailFromAddress',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:!=:0',
        'config' => [
            'type' => 'input',
            'size' => 25
        ]
    ],
    'pbsurvey_mail_from_name' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailFromName',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:!=:0',
        'config' => [
            'type' => 'input',
            'size' => 25,
            'default' => 'Survey'
        ]
    ],
    'pbsurvey_mail_send_type' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailSendType',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailSendType.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailSendType.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailSendType.2',
                    2
                ]
            ],
            'default' => 0,
            'size' => 1,
            'minitems' => 1,
            'maxitems' => 1
        ]
    ],
    'pbsurvey_mail_subject' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailSubject',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:!=:0',
        'config' => [
            'type' => 'input',
            'size' => 25,
            'default' => 'Survey !'
        ]
    ],
    'pbsurvey_mail_to' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.mailTo',
        'displayCond' => 'FIELD:pbsurvey_mail_send_type:!=:0',
        'config' => [
            'type' => 'input',
            'size' => 25
        ]
    ],
    'pbsurvey_maximum_responses' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.maximumResponses',
        'config' => [
            'type' => 'input',
            'size' => 8,
            'max' => 20,
            'eval' => 'int',
            'default' => 0
        ]
    ],
    'pbsurvey_navigation_back' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationBack',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationBack.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationBack.1',
                    1
                ]
            ]
        ]
    ],
    'pbsurvey_navigation_cancel' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationCancel',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationCancel.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationCancel.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationCancel.2',
                    2
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.navigationCancel.3',
                    3
                ]
            ]
        ]
    ],
    'pbsurvey_numbering_page' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingPage',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingPage.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingPage.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingPage.2',
                    2
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingPage.3',
                    3
                ]
            ],
            'default' => 1
        ]
    ],
    'pbsurvey_numbering_question' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingQuestion',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingQuestion.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingQuestion.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.numberingQuestion.2',
                    2
                ]
            ],
            'default' => 1
        ]
    ],
    'pbsurvey_responses_per_user' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.responsesPerUser',
        'config' => [
            'type' => 'input',
            'size' => 8,
            'max' => 20,
            'eval' => 'int',
            'default' => 0
        ]
    ],
    'pbsurvey_scoring' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.scoring',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_pbsurvey_score',
            'foreign_field' => 'parentid',
            'foreign_label' => 'score',
            'maxitems' => 10,
            'appearance' => [
                'collapseAll' => 1,
                'expandSingle' => 1,
                'useSortable' => 1
            ]
        ]
    ],
    'pbsurvey_storage_folder' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.storageFolder',
        'config' => [
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'pages',
            'size' => 1,
            'maxitems' => 1,
            'minitems' => 0,
            'show_thumbs' => 1
        ]
    ],
    'pbsurvey_validation' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.validation',
        'config' => [
            'type' => 'select',
            'items' => [
                [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.validation.0',
                    0
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.validation.1',
                    1
                ], [
                    'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:field.validation.2',
                    2
                ]
            ],
            'default' => 1
        ]
    ]
];

// Adding fields to the tt_content table definition in TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $extraTtContentColumns);

// Define fields which need to throw a refresh of the form
$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',' . implode(',', [
    'pbsurvey_access_level',
    'pbsurvey_mail_send_type'
]);

// Define all new content elements
$newContentElementCTypes = [
    'pbsurvey'
];

// Add the new content elements
foreach ($newContentElementCTypes as $newContentElementCType) {
    // Define the form for the content element
    $GLOBALS['TCA']['tt_content']['types'][$newContentElementCType] = [
        'showitem' => '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.header;header,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.storage,
                pbsurvey_storage_folder,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.mail,
                pbsurvey_mail_send_type,
                pbsurvey_mail_subject,
                pbsurvey_mail_from_address,
                pbsurvey_mail_from_name,
                pbsurvey_mail_to,
                pbsurvey_mail_cc,
                pbsurvey_mail_body,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.completion,
                pbsurvey_completion_action,
                pbsurvey_completion_page,
                pbsurvey_completion_close_button,
                pbsurvey_completion_continue_button,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.navigation,
                pbsurvey_navigation_back,
                pbsurvey_navigation_cancel,
                pbsurvey_cancel_page,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.numbering,
                pbsurvey_numbering_page,
                pbsurvey_numbering_question,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.scoring,
                pbsurvey_scoring,
            --div--;LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:tab.other,
                pbsurvey_maximum_responses,
                pbsurvey_responses_per_user,
                pbsurvey_days_for_update,
                pbsurvey_validation,
                pbsurvey_first_column_width,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
                pbsurvey_captcha,
                pbsurvey_access_level,
                pbsurvey_entering_stage,
                pbsurvey_anonymous_mode,
                pbsurvey_cookie_lifetime,
            --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
        '
    ];

    // Add the content element to the CType dropdown
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][$newContentElementCType] = [
        'LLL:EXT:pbsurvey/Resources/Private/Language/TCA/TtContent.xlf:CType.' . $newContentElementCType,
        $newContentElementCType,
        'mimetypes-x-content-' . $newContentElementCType
    ];

    // Add the icon class for the content element
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$newContentElementCType] = 'mimetypes-x-content-' . $newContentElementCType;
}
