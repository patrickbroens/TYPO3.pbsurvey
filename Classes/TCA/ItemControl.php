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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use PatrickBroens\Pbsurvey\Domain\Repository\ItemRepository;

/**
 * Abstract to control survey items
 */
class ItemControl extends Control
{
    /**
     * The item repository
     *
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * Constructor
     *
     * Set the item repository
     */
    public function __construct()
    {
        $this->itemRepository = GeneralUtility::makeInstance(ItemRepository::class);

        parent::__construct();
    }
}