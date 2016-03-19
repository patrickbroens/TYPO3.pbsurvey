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
 * Additional value validation
 */
class AdditionalValue extends AbstractErrorCheck
{
    /**
     * Check if the additional value has been set
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('additionalValue')
            && is_callable([$item, 'getAnswersAdditionalAllow'])
            && $item->getAnswersAdditionalAllow()
        ) {
            $validatorConfiguration = $item->getValidatorConfiguration('additionalValue');

            foreach ($item->getOptionRows() as $optionRow) {
                if ($optionRow->hasOption(-1)) {
                    $additionalOption = $optionRow->getOption(-1);

                    if (
                        $additionalOption->getChecked()
                        && $additionalOption->getValue() === ''
                    ) {
                        $validator->didNotValidate();
                        $item->addError($this->getErrorMessage($validatorConfiguration));
                        break;
                    }
                }
            }
        }
    }
}