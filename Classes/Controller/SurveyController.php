<?php
namespace PatrickBroens\Pbsurvey\Controller;

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

use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractItem;
use PatrickBroens\Pbsurvey\Domain\Model\Item\Abstracts\AbstractQuestion;
use PatrickBroens\Pbsurvey\Domain\Model\Page;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;
use PatrickBroens\Pbsurvey\Utility\ArrayUtility;
use TYPO3\CMS\Core\Http\ServerRequest;

/**
 * Survey controller
 */
class SurveyController extends AbstractController
{
    /**
     * The page provider
     *
     * @var PageProvider
     */
    protected $pages;

    /**
     * The server request
     *
     * @var ServerRequest
     */
    protected $serverRequest;

    /**
     * The user provider
     *
     * @var UserProvider
     */
    protected $user;

    /**
     * Constructor
     *
     * @param ServerRequest $serverRequest The server request
     * @param ConfigurationProvider $configuration The configuration provider
     * @param PageProvider $pages The page provider
     * @param UserProvider $user The user provider
     */
    public function __construct(
        ServerRequest $serverRequest,
        ConfigurationProvider $configuration,
        PageProvider $pages,
        UserProvider $user
    ) {
        $this->serverRequest = $serverRequest;
        $this->pages = $pages;
        $this->user = $user;

        parent::__construct($configuration);
    }

    /**
     * Display the survey
     *
     * @return string The rendered view
     */
    public function indexAction()
    {
        $this->setSession();

        $stage = $this->user->getStageNumber();
        $page = $this->pages->getPageByStageNumber($stage);

        // Collect the answers
        //$this->addAnswersToPageItems($page);

        /*if ($this->user->getStageNumber() !== 0) {
            $this->validate();
        }*/


        // Is there a result in the session, in the cookie or by ip address
        // Is there a stage in the session
        // If yes, use that one, otherwise set the stage 0 to the session

        // Get the results, stages and answers

        // If we have a "back" button, calculate new stage and delete stages after that one

        // If stage != 0, get the items from the previous stage
        // Load the answers in them
        // Do validation

        // If validation failed, set the stage to previous and show the page again.

        // If validation passed, store the result if necessary (store the result in $cookie and session),
        // the stage (sorting = index) and the answers
        // use a hash for identifying the result

        // Calculate conditions for new stage

        // Get the items from the new stage
        // Load the answers in them

        // Show


        $this->view->setTemplate('Survey');
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'page' => $page,
            'pages' => $this->pages,
            'user' => $this->user
        ]);
        return $this->view->render();
    }

    /**
     * Add answers to the page items
     *
     * @param Page $page The page
     */
    protected function addAnswersToPageItems($page)
    {
        $items = $page->getItems();

        if ($this->user->hasResult()) {
            $stage = $this->user->getResult()->getStageByNumber($this->user->getStageNumber());

            if (
                $stage
                && $stage->hasAnswers()
            ) {
                foreach ($items as $item) {
                    if (
                        $item instanceof AbstractQuestion
                    ) {
                        $item->setAnswers($stage->getAnswersByItemUid($item->getUid()));
                    }
                }
            }
        }
    }


    /**
     * Start a new session if it not available yet
     * or continue a session
     */
    protected function setSession()
    {
        if (!$this->user->hasSession()) {
            $this->user->startSession($this->configuration);
        } else {
            $this->user->continueSession($this->serverRequest);
        }
    }
}