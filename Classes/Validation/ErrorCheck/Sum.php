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
 * Sum validation
 */
class Sum extends AbstractErrorCheck
{
    /**
     * Check if sum of all values is right
     *
     * @param Validator $validator The validator
     * @param AbstractQuestion $item The item
     */
    public function check(
        Validator $validator,
        AbstractQuestion $item
    ) {
        if (
            $item->needsValidator('sum')
            && is_callable([$item, 'getNumberTotal'])
        ) {
            $validatorConfiguration = $item->getValidatorConfiguration('sum');

            $sum = $responsesCount = 0;

            foreach ($item->getOptionRows() as $optionRow) {
                foreach ($optionRow->getOptions() as $option) {
                    if ($option->getValue() !== '') {
                        $sum += (int)$option->getValue();
                        $responsesCount++;
                    }
                }
            }

            // Only validate when there are responses, required will check on zero
            if (
                $responsesCount !== 0
                && $sum !== $item->getNumberTotal()
            ) {
                $validator->didNotValidate();
                $item->addError($this->getErrorMessage(
                    $validatorConfiguration,
                    $item->getNumberTotal()
                ));
            }
        }
    }
}