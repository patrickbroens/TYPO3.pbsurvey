<?php
namespace PatrickBroens\Pbsurvey\Validation\ErrorCheck;

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
use PatrickBroens\Pbsurvey\Validation\Validator;

/**
 * Validation if the sum is an integer
 */
class RequiredSum extends AbstractErrorCheck
{
    /**
     * Check if the sum is an integer
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('requiredSum')
            && $item->getOptionsRequired()
        ) {
            $validatorConfiguration = $item->getValidatorConfiguration('requiredSum');

            $sum = 0;

            foreach ($item->getOptionRows() as $optionRow) {
                foreach ($optionRow->getOptions() as $option) {
                    $sum += (int)$option->getValue();
                }
            }

            if ($sum === 0) {
                $validator->didNotValidate();
                $item->addError($this->getErrorMessage($validatorConfiguration));
            }
        }
    }
}