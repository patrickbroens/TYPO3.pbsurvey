<?php
namespace PatrickBroens\Pbsurvey\TCA\LabelUserFunc;

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

use PatrickBroens\Pbsurvey\TCA\Control;

/**
 * Create label for page condition groups
 */
class PageConditionGroup extends Control
{
    /**
     * The template root paths
     *
     * @var array
     */
    protected static $templateRootPaths = [
        'EXT:pbsurvey/Resources/Private/Template/Backend/TCA/PageConditionGroup/LabelUserFunc/'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the label for a page condition group
     *
     * Depending on the settings it will show an error if conditions are not met
     *
     * @param array $parameters The parameters
     * @param null $null Null parameter
     * @return string
     */
    public function render(&$parameters, $null)
    {
        $groupName = $parameters['row']['name'];

        $groupNameSet = !empty($groupName);

        $parameters['title'] = $this->renderLabel($groupNameSet, $groupName);
    }

    /**
     * Render the label
     *
     * @param string $groupNameSet true if group name has been set
     * @param string $groupName The group name
     * @return string The label markup
     */
    protected function renderLabel($groupNameSet, $groupName)
    {
        $this->view->setTemplate('Label');
        $this->view->assignMultiple([
            'groupNameSet' => $groupNameSet,
            'groupName' => $groupName
        ]);

        return $this->view->render();
    }
}