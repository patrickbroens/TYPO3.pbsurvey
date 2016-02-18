<?php
defined('TYPO3_MODE') or die();

// Register hook to update the answers after selecting a predefined answer group
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['pbsurvey'] =
    \PatrickBroens\Pbsurvey\Hook\ProcessDataMap::class;

// Get the icon registry
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

/**
 * Add the icons for the new content elements to the icon registry
 */
$newContentElementCTypes = [
    'pbsurvey'
];

foreach ($newContentElementCTypes as $newContentElementCType) {

    // Add the content element icon to the icon registry
    $iconRegistry->registerIcon(
        'mimetypes-x-content-' . $newContentElementCType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:pbsurvey/Resources/Public/Icons/ContentElements/' . $newContentElementCType . '.gif'
        ]
    );

    // Add the content element icon to the icon registry for the content element wizard
    $iconRegistry->registerIcon(
        'content-special-' . $newContentElementCType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:pbsurvey/Resources/Public/Icons/ContentElementWizard/' . $newContentElementCType . '.gif'
        ]
    );
}

/**
 * Add the icons for record types to the icon registry
 */
$recordTypes = [
    'answer',
    'item',
    'option',
    'option-predefined',
    'option-predefined-group',
    'option_row',
    'page',
    'page-condition-group',
    'page-condition-rule',
    'result',
    'score'
];

foreach ($recordTypes as $recordType) {
    $iconRegistry->registerIcon(
        'mimetypes-x-pbsurvey-' . $recordType,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:pbsurvey/Resources/Public/Icons/TCA/' . $recordType . '.gif'
        ]
    );
}

/**
 * Add icons to the icon registry for all item types
 */
$itemsAmount = 24;

for ($itemNumber = 1; $itemNumber <= $itemsAmount; $itemNumber++) {
    $iconRegistry->registerIcon(
        'mimetypes-x-pbsurvey-item-' . $itemNumber,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        [
            'source' => 'EXT:pbsurvey/Resources/Public/Icons/TCA/Item/' . $itemNumber . '.gif'
        ]
    );
}

// Register the item classes
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['items'] = [
    1 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceMultipleAnswersCheckboxes',
    2 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceOneAnswerDropdown',
    3 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceOneAnswerOptionButtons',
    4 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceTrueFalse',
    5 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceYesNo',
    23 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceMultipleAnswersSelectbox',
    24 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\ChoiceImageRating',
    6 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\MatrixMultipleAnswersPerRowCheckboxes',
    7 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\MatrixMultipleAnswersPerRowTextboxes',
    8 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\MatrixOneAnswerPerRowOptionButtons',
    9 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\MatrixRatingScaleNumeric',
    10 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedCommentsBox',
    11 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedConstantSum',
    12 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedDate',
    13 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedNumber',
    14 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedOneLine',
    15 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedOneOrMoreLines',
    16 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\OpenEndedRanking',
    17 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\PresentationHeading',
    18 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\PresentationHorizontalRule',
    19 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\PresentationHtml',
    20 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\PresentationImage',
    21 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\PresentationMessage',
    99 => 'PatrickBroens\Pbsurvey\Domain\Model\Item\CallUserDefinedHook'
];

// Include TS configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:pbsurvey/Configuration/TSconfig/Root.ts">'
);

// Update wizard 4.7 => 7.6
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['pbsurvey'] =
    \PatrickBroens\Pbsurvey\Updates\Upgrade::class;