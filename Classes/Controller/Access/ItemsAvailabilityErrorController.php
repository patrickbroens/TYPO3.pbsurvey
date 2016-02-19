<?php
namespace PatrickBroens\Pbsurvey\Controller\Access;

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

use PatrickBroens\Pbsurvey\Controller\AbstractController;

/**
 * Error controller when there are no pages and items at all
 */
class ItemsAvailabilityErrorController extends AbstractController
{
    /**
     * Display an error page
     *
     * @return string The rendered view
     */
    public function indexAction()
    {
        $this->view->setTemplate('Access/ItemsAvailabilityError');
        return $this->view->render();
    }
}