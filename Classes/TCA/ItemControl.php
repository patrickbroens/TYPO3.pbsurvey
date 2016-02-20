<?php
namespace PatrickBroens\Pbsurvey\TCA;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use PatrickBroens\Pbsurvey\DataProvider\ItemProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Abstract to control survey items
 */
class ItemControl extends Control
{
    /**
     * The item provider
     *
     * @var ItemProvider
     */
    protected $itemProvider;

    /**
     * Initialize the data provider and set the item provider
     *
     * @param int $pageUid The page uid where the dataprovider has to collect the data
     */
    public function setItemProvider($pageUid)
    {
        $this->dataProvider->initialize((int)$pageUid);
        $this->itemProvider = $this->dataProvider->getProvider('item');
    }
}