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
 * Maximum date validation
 */
class DateMaximum extends AbstractErrorCheck
{
    /**
     * Check if values are a above minimum date
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('dateMaximum')
            && is_callable([$item, 'getDateMaximum'])
            && is_callable([$item, 'getDateMinimum'])
            && $item->getDateMaximum() > 0
        ) {
            $validatorConfiguration = $item->getValidatorConfiguration('dateMaximum');

            foreach ($item->getOptionRows() as $optionRow) {
                foreach ($optionRow->getOptions() as $option) {
                    $value = $option->getValue();
                    $date = \DateTime::createFromFormat('d-m-Y', $value);
                    $dateMaximum = \DateTime::createFromFormat('d-m-Y', $item->getDateMaximum());

                    if (
                        $value !== ''
                        && $date
                        && $date > $dateMaximum

                    ) {
                        $validator->didNotValidate();
                        $item->addError($this->getErrorMessage(
                            $validatorConfiguration,
                            $item->getDateMaximum()
                        ));
                    }
                }
            }
        }
    }
}