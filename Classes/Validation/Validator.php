<?php
namespace PatrickBroens\Pbsurvey\Validation;

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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * Validator
 */
class Validator
{
    /**
     * False when a page item did not succeed validating
     *
     * @var bool
     */
    protected $valid = true;

    /**
     * Validate the page and its items
     *
     * @param Page $page The page to validate
     * @return bool true if page is valid
     */
    public function validate(Page $page)
    {
        $items = $page->getItems();

        foreach ($items as $item) {
            if ($item instanceof AbstractQuestion) {
                $this->emitErrorCheckSignal($item);
            }
        }

        $page->setValidationResult($this->valid);

        return $this->valid;
    }

    /**
     * Emit signal to check item on validation errors
     *
     * @param AbstractQuestion $item
     */
    public function emitErrorCheckSignal(
        AbstractQuestion $item
    ) {
        $signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
        $signalSlotDispatcher->dispatch(
            __CLASS__,
            'ErrorCheck',
            [
                $this,
                $item
            ]
        );
    }

    /**
     * Set to false if an item did not validate
     *
     * This can be called from within a slot
     */
    public function didNotValidate()
    {
        $this->valid = false;
    }
}