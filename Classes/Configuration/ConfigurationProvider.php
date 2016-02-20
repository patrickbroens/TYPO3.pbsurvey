<?php
namespace PatrickBroens\Pbsurvey\Configuration;

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

use PatrickBroens\Pbsurvey\Domain\Model\Score;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Configuration provider
 *
 * Configuration of the content element in tt_content and TypoScript
 *
 * TypoScript is loaded first, everything set in tt_content overrides TypoScript
 */
class ConfigurationProvider implements SingletonInterface
{
    /**
     * Respondent Access Level
     *
     * 0: Multiple Response
     * 1: Single Response
     * 2: Single Response (Not Updateable)
     * 3: Single Response (Not Updateable after finish)
     *
     * @var int
     */
    protected $accessLevel;

    /**
     * Anonymous check
     *
     * 0: IP-address
     * 1: Cookie
     *
     * @var int
     */
    protected $anonymousMode;

    /**
     * Page to go to when the "Cancel" button has been clicked
     *
     * @var int
     */
    protected $cancelPage;

    /**
     * Show Captcha before entering survey
     *
     * @var bool
     */
    protected $captcha;

    /**
     * Completion Action
     *
     * 0: Close the browser
     * 1: Display Message
     * 2: Redirect to another page
     * 3: Redirect to scoring pages
     *
     * @var int
     */
    protected $completionAction;

    /**
     * Show "Close" button when the survey has been completed
     *
     * @var bool
     */
    protected $completionCloseButton;

    /**
     * Show "Continue" button when the survey has been completed
     *
     * @var bool
     */
    protected $completionContinueButton;

    /**
     * Page to go to when the survey has been completed
     *
     * @var int
     */
    protected $completionPage;

    /**
     * Cookie lifetime (in days)
     *
     * @var int
     */
    protected $cookieLifetime;

    /**
     * The amount of days a respondent can update his/her answers
     *
     * @var int
     */
    protected $daysForUpdate;

    /**
     * Begin stage when restarting
     *
     * 0: At the beginning of the survey
     * 1: At the point where user left the survey
     *
     * @var bool
     */
    protected $enteringStage;

    /**
     * First column width for matrix questions (percentage)
     *
     * @var int
     */
    protected $firstColumnWidth;

    /**
     * The layout root paths
     *
     * @var array
     */
    protected $layoutRootPaths;

    /**
     * Body text of the email
     *
     * @var string
     */
    protected $mailBody;

    /**
     * Carbon copy address of the email
     *
     * @var string
     */
    protected $mailCc;

    /**
     * The email address the email is sent from
     *
     * @var string
     */
    protected $mailFromAddress;

    /**
     * The name the email is sent from
     *
     * @var string
     */
    protected $mailFromName;

    /**
     * Type of mail which should be sent
     *
     * 0: No mail
     * 1: Send: Question / Answer
     * 2: Send: Default message
     *
     * @var int
     */
    protected $mailSendType;

    /**
     * The subject of the email
     *
     * @var string
     */
    protected $mailSubject;

    /**
     * The email address of the receiver of the email
     *
     * @var string
     */
    protected $mailTo;

    /**
     * The maximum amount of responses to the survey
     * When the maximum amount has been reached, the survey is unavailable
     *
     * @var int
     */
    protected $maximumResponses;

    /**
     * Show the "Back" button
     *
     * @var bool
     */
    protected $navigationBack;

    /**
     * Action when the "Cancel" button has been clicked
     * or hide it
     *
     * 0: Do not display
     * 1: Close browser
     * 2: Redirect to end of survey
     * 3: Redirect to custom page (see $cancelPage)
     *
     * @var int
     */
    protected $navigationCancel;

    /**
     * Page Numbering
     *
     * 0: Do not display page numbers
     * 1: Display progress as a progress bar
     * 2: Display progress in 'Page X of Y' format
     * 3: Display page number on each page
     *
     * @var int
     */
    protected $numberingPage;

    /**
     * Question Numbering
     *
     * 0: Do not display question numbers
     * 1: Number questions within entire questionaire
     * 2: Number questions within each page
     *
     * @var int
     */
    protected $numberingQuestion;

    /**
     * The partial root paths
     *
     * @var array
     */
    protected $partialRootPaths;

    /**
     * Maximum amount of responses per user
     *
     * @var int
     */
    protected $responsesPerUser;

    /**
     * The scoring
     *
     * @var Score[]
     */
    protected $scoring;

    /**
     * The storage folder for survey pages
     *
     * @var int
     */
    protected $storageFolder;

    /**
     * The template root paths
     *
     * @var array
     */
    protected $templateRootPaths;

    /**
     * Form validation method
     *
     * 0: Client-side Javascript
     * 1: Server-side PHP
     * 2: Both Server-side and Client-side
     *
     * @var int
     */
    protected $validation;

    /**
     * Get the Respondent Access Level
     *
     * @return int
     */
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    /**
     * Set the Respondent Access Level
     *
     * @param int $accessLevel The Respondent Access Level
     */
    public function setAccessLevel($accessLevel)
    {
        $this->accessLevel = (int)$accessLevel;
    }

    /**
     * Get the Anonymous check
     *
     * @return int
     */
    public function getAnonymousMode()
    {
        return $this->anonymousMode;
    }

    /**
     * Set the Anonymous check
     *
     * @param int $anonymousMode The anonymous mode
     */
    public function setAnonymousMode($anonymousMode)
    {
        $this->anonymousMode = (int)$anonymousMode;
    }

    /**
     * Get the page to go to when the "Cancel" button has been clicked
     *
     * @return int
     */
    public function getCancelPage()
    {
        return $this->cancelPage;
    }

    /**
     * Set the page to go to when the "Cancel" button has been clicked
     *
     * @param int $cancelPage The cancel page uid
     */
    public function setCancelPage($cancelPage)
    {
        $this->cancelPage = (int)$cancelPage;
    }

    /**
     * Alias for getCaptcha()
     *
     * @return boolean
     */
    public function hasCaptcha()
    {
        return $this->getCaptcha();
    }

    /**
     * Check if captcha is shown before entering the survey
     *
     * @return boolean
     */
    public function getCaptcha()
    {
        return $this->captcha;
    }

    /**
     * Set if captcha is shown before entering survey
     *
     * @param boolean $captcha True if captcha needs to be shown
     */
    public function setCaptcha($captcha)
    {
        $this->captcha = (bool)$captcha;
    }

    /**
     * Get the completion action
     *
     * @return int
     */
    public function getCompletionAction()
    {
        return $this->completionAction;
    }

    /**
     * Set the completion action
     *
     * @param int $completionAction The completion action
     */
    public function setCompletionAction($completionAction)
    {
        $this->completionAction = (int)$completionAction;
    }

    /**
     * Alias for getCompletionCloseButton()
     *
     * @return boolean
     */
    public function hasCompletionCloseButton()
    {
        return $this->getCompletionCloseButton();
    }

    /**
     * Check if "Close" button should be shown when the survey has been completed
     *
     * @return boolean
     */
    public function getCompletionCloseButton()
    {
        return $this->completionCloseButton;
    }

    /**
     * Set if "Close" button should be shown when the survey has been completed
     *
     * @param boolean $completionCloseButton True if button needs to be shown
     */
    public function setCompletionCloseButton($completionCloseButton)
    {
        $this->completionCloseButton = (bool)$completionCloseButton;
    }

    /**
     * Alias for getCompletionContinueButton()
     *
     * @return boolean
     */
    public function hasCompletionContinueButton()
    {
        return $this->getCompletionContinueButton();
    }

    /**
     * Check if "Continue" button should be shown when the survey has been completed
     *
     * @return boolean
     */
    public function getCompletionContinueButton()
    {
        return $this->completionContinueButton;
    }

    /**
     * Set if "Continue" button should be shown when the survey has been completed
     *
     * @param boolean $completionContinueButton True if button needs to be shown
     */
    public function setCompletionContinueButton($completionContinueButton)
    {
        $this->completionContinueButton = (bool)$completionContinueButton;
    }

    /**
     * Get the page to go to when the survey has been completed
     *
     * @return int
     */
    public function getCompletionPage()
    {
        return $this->completionPage;
    }

    /**
     * Set the page to go to when the survey has been completed
     *
     * @param int $completionPage The completion page uid
     */
    public function setCompletionPage($completionPage)
    {
        $this->completionPage = (int)$completionPage;
    }

    /**
     * Get the cookie lifetime (in days)
     *
     * @return int
     */
    public function getCookieLifetime()
    {
        return $this->cookieLifetime;
    }

    /**
     * Set the cookie lifetime (in days)
     *
     * @param int $cookieLifetime The cookie lifetime
     */
    public function setCookieLifetime($cookieLifetime)
    {
        $this->cookieLifetime = (int)$cookieLifetime;
    }

    /**
     * Get the amount of days a respondent can update his/her answers
     *
     * @return int
     */
    public function getDaysForUpdate()
    {
        return $this->daysForUpdate;
    }

    /**
     * Set the amount of days a respondent can update his/her answers
     *
     * @param int $daysForUpdate The days
     */
    public function setDaysForUpdate($daysForUpdate)
    {
        $this->daysForUpdate = (int)$daysForUpdate;
    }

    /**
     * Alias for getEnteringStage()
     *
     * @return boolean
     */
    public function hasEnteringStage()
    {
        return $this->getEnteringStage();
    }

    /**
     * Get the begin stage when restarting a survey
     *
     * @return boolean
     */
    public function getEnteringStage()
    {
        return $this->enteringStage;
    }

    /**
     * Set the begin stage when restarting a survey
     *
     * @param boolean $enteringStage The entering stage
     */
    public function setEnteringStage($enteringStage)
    {
        $this->enteringStage = (bool)$enteringStage;
    }

    /**
     * Get the first column width for matrix questions (percentage)
     *
     * @return int
     */
    public function getFirstColumnWidth()
    {
        return $this->firstColumnWidth;
    }

    /**
     * Set the first column width for matrix questions (percentage)
     *
     * @param int $firstColumnWidth The column width
     */
    public function setFirstColumnWidth($firstColumnWidth)
    {
        $this->firstColumnWidth = (int)$firstColumnWidth;
    }

    /**
     * Get the layout root paths
     *
     * @return array
     */
    public function getLayoutRootPaths()
    {
        return $this->layoutRootPaths;
    }

    /**
     * Set the layout root paths
     *
     * @param array $layoutRootPaths The layout root paths
     */
    public function setLayoutRootPaths(array $layoutRootPaths)
    {
        $this->layoutRootPaths = $layoutRootPaths;
    }

    /**
     * Get the body text of the email
     *
     * @return string
     */
    public function getMailBody()
    {
        return $this->mailBody;
    }

    /**
     * Set the body text of the email
     *
     * @param string $mailBody The mail body
     */
    public function setMailBody($mailBody)
    {
        $this->mailBody = (string)$mailBody;
    }

    /**
     * Get the carbon copy address of the email
     *
     * @return string
     */
    public function getMailCc()
    {
        return $this->mailCc;
    }

    /**
     * Set the carbon copy address of the email
     *
     * @param string $mailCc The Cc email address
     */
    public function setMailCc($mailCc)
    {
        $this->mailCc = (string)$mailCc;
    }

    /**
     * Get the email address the email is sent from
     *
     * @return string
     */
    public function getMailFromAddress()
    {
        return $this->mailFromAddress;
    }

    /**
     * Set the email address the email is sent from
     *
     * @param string $mailFromAddress The email address
     */
    public function setMailFromAddress($mailFromAddress)
    {
        $this->mailFromAddress = (string)$mailFromAddress;
    }

    /**
     * Get the name the email is sent from
     *
     * @return string
     */
    public function getMailFromName()
    {
        return $this->mailFromName;
    }

    /**
     * Set the name the email is sent from
     *
     * @param string $mailFromName The name
     */
    public function setMailFromName($mailFromName)
    {
        $this->mailFromName = (string)$mailFromName;
    }

    /**
     * Get the type of mail which should be sent
     *
     * @return int
     */
    public function getMailSendType()
    {
        return $this->mailSendType;
    }

    /**
     * Set the type of mail which should be sent
     *
     * @param int $mailSendType The type
     */
    public function setMailSendType($mailSendType)
    {
        $this->mailSendType = (int)$mailSendType;
    }

    /**
     * Get the subject of the email
     *
     * @return string
     */
    public function getMailSubject()
    {
        return $this->mailSubject;
    }

    /**
     * Set the subject of the email
     *
     * @param string $mailSubject The email subject
     */
    public function setMailSubject($mailSubject)
    {
        $this->mailSubject = (string)$mailSubject;
    }

    /**
     * Get the email address of the receiver of the email
     *
     * @return string
     */
    public function getMailTo()
    {
        return $this->mailTo;
    }

    /**
     * Set the email address of the receiver of the email
     *
     * @param string $mailTo The email address
     */
    public function setMailTo($mailTo)
    {
        $this->mailTo = (string)$mailTo;
    }

    /**
     * Get the maximum amount of responses to the survey
     *
     * @return int
     */
    public function getMaximumResponses()
    {
        return $this->maximumResponses;
    }

    /**
     * Set the maximum amount of responses to the survey
     *
     * @param int $maximumResponses The maximum responses
     */
    public function setMaximumResponses($maximumResponses)
    {
        $this->maximumResponses = (int)$maximumResponses;
    }

    /**
     * Alias for getNavigationBack()
     *
     * @return boolean
     */
    public function hasNavigationBack()
    {
        return $this->getNavigationBack();
    }

    /**
     * Check if the "Back" button should be shown
     *
     * @return boolean
     */
    public function getNavigationBack()
    {
        return $this->navigationBack;
    }

    /**
     * Set if the "Back" button should be shown
     *
     * @param boolean $navigationBack true if "Back" button should be shown
     */
    public function setNavigationBack($navigationBack)
    {
        $this->navigationBack = (bool)$navigationBack;
    }

    /**
     * Get the action when the "Cancel" button has been clicked, or hidden
     *
     * @return int
     */
    public function getNavigationCancel()
    {
        return $this->navigationCancel;
    }

    /**
     * Set the action when the "Cancel" button has been clicked, or hidden
     *
     * @param int $navigationCancel The cancel action
     */
    public function setNavigationCancel($navigationCancel)
    {
        $this->navigationCancel = (int)$navigationCancel;
    }

    /**
     * Get the page numbering method
     *
     * @return int
     */
    public function getNumberingPage()
    {
        return $this->numberingPage;
    }

    /**
     * Set the page numbering method
     *
     * @param int $numberingPage The page numbering method
     */
    public function setNumberingPage($numberingPage)
    {
        $this->numberingPage = (int)$numberingPage;
    }

    /**
     * Get the question numbering method
     *
     * @return int
     */
    public function getNumberingQuestion()
    {
        return $this->numberingQuestion;
    }

    /**
     * Set the question numbering method
     *
     * @param int $numberingQuestion The question numbering method
     */
    public function setNumberingQuestion($numberingQuestion)
    {
        $this->numberingQuestion = (int)$numberingQuestion;
    }

    /**
     * Get the partial root paths
     *
     * @return array
     */
    public function getPartialRootPaths()
    {
        return $this->partialRootPaths;
    }

    /**
     * Set the partial root paths
     *
     * @param array $partialRootPaths The partial root paths
     */
    public function setPartialRootPaths(array $partialRootPaths)
    {
        $this->partialRootPaths = $partialRootPaths;
    }

    /**
     * Get the maximum amount of responses per user
     *
     * @return int
     */
    public function getResponsesPerUser()
    {
        return $this->responsesPerUser;
    }

    /**
     * Set the maximum amount of responses per user
     *
     * @param int $responsesPerUser Maximum amount of responses
     */
    public function setResponsesPerUser($responsesPerUser)
    {
        $this->responsesPerUser = (int)$responsesPerUser;
    }

    /**
     * Check if a scoring exists
     *
     * @param int $scoringUid The scoring uid
     * @return bool
     */
    public function hasScoring($scoringUid)
    {
        return isset($this->scoring[$scoringUid]);
    }

    /**
     * Get a scoring by its uid
     *
     * @var int $scoringUid The scoring uid
     * @return null|Score[]
     */
    public function getScoring($scoringUid)
    {
        $scoring = null;

        if ($this->hasScoring($scoringUid)) {
            $scoring = $this->scoring[$scoringUid];
        }

        return $scoring;
    }

    /**
     * Add a scoring
     *
     * @param Score $score The scoring
     */
    public function addScoring(Score $score)
    {
        $this->scoring[$score->getUid()] = $score;
    }

    /**
     * Check if scorings exist
     *
     * @return bool
     */
    public function hasScorings()
    {
        return !empty($this->scoring);
    }

    /**
     * Get the scorings
     *
     * @return Score[]
     */
    public function getScorings()
    {
        return $this->scoring;
    }

    /**
     * Set the scorings
     *
     * @param Score[] $scorings The scorings
     */
    public function addScorings(array $scorings)
    {
        foreach ($scorings as $scoring) {
            if ($scoring instanceof Score) {
                $this->addScoring($scoring);
            }
        }
    }

    /**
     * Get the storage folder
     *
     * @return int
     */
    public function getStorageFolder()
    {
        return $this->storageFolder;
    }

    /**
     * Set the storage folder
     *
     * @param int $storageFolder The storage folder uid
     */
    public function setStorageFolder($storageFolder)
    {
        $this->storageFolder = (int)$storageFolder;
    }

    /**
     * Get the template root paths
     *
     * @return array
     */
    public function getTemplateRootPaths()
    {
        return $this->templateRootPaths;
    }

    /**
     * Set the template root paths
     *
     * @param array $templateRootPaths The template root paths
     */
    public function setTemplateRootPaths(array $templateRootPaths)
    {
        $this->templateRootPaths = $templateRootPaths;
    }

    /**
     * Get the validation method
     *
     * @return int
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * Set the validation method
     *
     * @param int $validation The validation method
     */
    public function setValidation($validation)
    {
        $this->validation = (int)$validation;
    }
}