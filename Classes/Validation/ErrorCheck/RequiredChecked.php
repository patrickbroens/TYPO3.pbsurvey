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
 * Required checked option validation
 */
class RequiredChecked extends AbstractErrorCheck
{
    /**
     * Check if the item needs a required checked option
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('requiredChecked')
            && $item->getOptionsRequired()
        ) {
            $isValid = false;

            $validatorConfiguration = $item->getValidatorConfiguration('requiredChecked');

            foreach ($item->getOptionRows() as $optionRow) {
                foreach ($optionRow->getOptions() as $option) {
                    if ($option->getChecked() === true) {
                        $isValid = true;
                        break 2;
                    }
                }
            }

            if (!$isValid) {
                $validator->didNotValidate();
                $item->addError($this->getErrorMessage($validatorConfiguration));
            }
        }
    }
}