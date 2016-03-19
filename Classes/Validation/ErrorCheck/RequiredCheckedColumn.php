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
 * Validation to check if there is a checked option in each column
 */
class RequiredCheckedColumn extends AbstractErrorCheck
{
    /**
     * Check if the item is required
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('requiredCheckedColumn')
            && $item->getOptionsRequired()
        ) {
            $validatorConfiguration = $item->getValidatorConfiguration('requiredCheckedColumn');

            $columns = [];
            $responsesCount = 0;

            foreach ($item->getOptionRows() as $optionRow) {
                foreach ($optionRow->getOptions() as $option) {
                    if ($option->getChecked() === true) {
                        $responsesCount++;
                        $columns[$option->getUid()] = $option->getUid();
                    }
                }
            }

            if (
                $responsesCount !== count($item->getOptions())
                || $responsesCount !== count($columns)
            ) {
                $validator->didNotValidate();
                $item->addError($this->getErrorMessage(
                    $validatorConfiguration,
                    count($item->getOptions())
                ));
            }
        }
    }
}