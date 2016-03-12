<?php
namespace PatrickBroens\Pbsurvey\Http;

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
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Utility\Reflection;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * HTTP request data
 */
class RequestData
{
    /**
     * The answers
     *
     * @var Answer[]
     */
    protected $answers = [];

    /**
     * True when back button has been pushed
     *
     * @var bool
     */
    protected $back;

    /**
     * True when cancel button has been pushed
     *
     * @var bool
     */
    protected $cancel;

    /**
     * True when submit button has been pushed
     *
     * @var bool
     */
    protected $submit;

    /**
     * The raw request data
     *
     * @var array
     */
    protected $surveyRequestData;

    /**
     * Constructor
     *
     * @param string $sessionKey The session key
     * @param array $requestData The server request data ($_POST)
     */
    public function __construct($sessionKey, $requestData)
    {
        if (
            is_array($requestData)
            && isset($requestData[$sessionKey])
        ) {
            $this->surveyRequestData = $requestData[$sessionKey];

            $this->setPredefinedProperties($this->surveyRequestData);
        }
    }

    /**
     * Add the answers to the page items
     *
     * Validate if an item exists
     * Convert the request data to answers
     * Merge the answers with the item options
     *
     * @param Page $page The page
     */
    public function addAnswersToPageItems(Page $page)
    {
        foreach ($this->surveyRequestData as $key => $itemAnswers) {
            if (is_int($key)) {
                $itemUid = (int)$key;

                if ($page->hasItem($itemUid)) {

                    // Item is available on page
                    /** @var AbstractQuestion $item */
                    $item = $page->getItem($itemUid);

                    if ($item instanceof AbstractQuestion) {
                        $this->setAnswers($itemUid, $item->convertRequestDataToAnswers($itemAnswers));
                        $item->mergeAnswers();
                    }
                }
            }
        }
    }

    /**
     * Get all answers
     *
     * @return array
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set the answers for a certain item
     *
     * @param int $itemUid The item uid
     * @param Answer[] $answers The answers
     */
    public function setAnswers($itemUid, array $answers)
    {
        $this->answers[(int)$itemUid] = $answers;
    }

    /**
     * Has the back button been pushed
     *
     * @return boolean
     */
    public function isBack()
    {
        return $this->back;
    }

    /**
     * Set if back button has been pushed
     *
     * @param boolean $back
     */
    protected function setBack($back)
    {
        $this->back = (bool)$back;
    }

    /**
     * Has the cancel button been pushed
     *
     * @return boolean
     */
    public function isCancel()
    {
        return $this->cancel;
    }

    /**
     * Set if cancel button has been pushed
     *
     * @param boolean $cancel
     */
    protected function setCancel($cancel)
    {
        $this->cancel = (bool)$cancel;
    }

    /**
     * Has the submit button been pushed
     *
     * @return boolean
     */
    public function isSubmit()
    {
        return $this->submit;
    }

    /**
     * Set if submit button has been pushed
     *
     * @param boolean $submit
     */
    protected function setSubmit($submit)
    {
        $this->submit = (bool)$submit;
    }

    /**
     * Store the predefined properties
     *
     * @param array $surveyRequestData The survey request data
     */
    protected function setPredefinedProperties(array $surveyRequestData)
    {
        $reflection = GeneralUtility::makeInstance(Reflection::class, $this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $type = $reflection->getPropertyTag($property, 'var');

            $method = 'set' . ucfirst($property->name);

            if (
                $type !== 'array'
                && is_callable([$this, $method])
                && isset($surveyRequestData[$property->name])
            ) {
                $this->$method($surveyRequestData[$property->name]);
            }
        }
    }
}