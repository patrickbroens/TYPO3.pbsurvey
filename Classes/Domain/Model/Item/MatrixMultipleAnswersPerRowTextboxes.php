<?php
namespace PatrickBroens\Pbsurvey\Domain\Model\Item;

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

use PatrickBroens\Pbsurvey\Domain\Model\Answer;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractMatrix;

/**
 * Item type 7: Matrix - Multiple Answers per Row (Textboxes)
 */
class MatrixMultipleAnswersPerRowTextboxes extends AbstractMatrix
{
    /**
     * Set the answers from the request data
     *
     * Checks if option rows and options are available.
     * If so, fills the values in the options
     * Secondly it will construct an answer for storage
     *
     * @param array $answers The answers from the request data
     * @return Answer[] The answers for storage
     */
    public function convertRequestDataToAnswers(array $answers)
    {
        // Iterate the answers for this item
        foreach ($answers as $optionRowUid => $options) {
            $optionRowUid = (int)$optionRowUid;

            // Check if option row is available and we got an array as input
            if (
                $this->hasOptionRow($optionRowUid)
                && is_array($options)
            ) {
                // Get the option row
                $optionRow = $this->getOptionRow($optionRowUid);

                // Iterate the options
                foreach ($options as $optionUid => $value) {
                    $optionUid = (int)$optionUid;

                    // Check if option is available in the option row
                    if (
                        $optionRow->hasOption($optionUid)
                        && is_string($value)
                    ) {

                        // Get the option
                        $option = $optionRow->getOption($optionUid);

                        $option->setChecked(true);
                        $option->setValue($value);

                        $this->setAnswer(
                            $optionRowUid,
                            $optionUid,
                            $value
                        );
                    }
                }
            }
        }

        return $this->getAnswers();
    }
}