<?php
namespace PatrickBroens\Pbsurvey\Hook;

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
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\Element\PageProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;

/**
 * Call user defined hook interface
 */
interface CallUserDefinedHookInterface
{
    /**
     * Add content from a hook
     *
     * @param ConfigurationProvider $configuration
     * @param UserProvider $user
     * @param PageProvider $pages
     * @return string
     */
    public function hookItemProcessor(
        ConfigurationProvider $configuration,
        UserProvider $user,
        PageProvider $pages
    );
}