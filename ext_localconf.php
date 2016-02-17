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
 * Register the item class names and add icons to the icon registry for all item types
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

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pbsurvey']['items'][$itemNumber] =
        'PatrickBroens\Pbsurvey\Domain\Model\Item\ItemType' . $itemNumber;
}

// Include TS configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:pbsurvey/Configuration/TSconfig/Root.ts">'
);

// Update wizard 4.7 => 7.6
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['pbsurvey'] =
    \PatrickBroens\Pbsurvey\Updates\Upgrade::class;