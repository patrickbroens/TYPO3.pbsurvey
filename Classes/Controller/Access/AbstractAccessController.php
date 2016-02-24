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
use PatrickBroens\Pbsurvey\Provider\Access\AccessProvider;
use PatrickBroens\Pbsurvey\Provider\Configuration\ConfigurationProvider;
use PatrickBroens\Pbsurvey\Provider\User\UserProvider;

/**
 * Abstract access controller
 */
abstract class AbstractAccessController extends AbstractController
{
    /**
     * The access provider
     *
     * @var AccessProvider
     */
    protected $access;

    /**
     * The user provider
     *
     * @var UserProvider
     */
    protected $user;

    /**
     * Constructor
     *
     * @param AccessProvider $access The access provider
     * @param ConfigurationProvider $configuration The configuration provider
     * @param UserProvider $user The user provider
     */
    public function __construct(
        AccessProvider $access,
        ConfigurationProvider $configuration,
        UserProvider $user
    )
    {
        $this->access = $access;
        $this->user = $user;

        parent::__construct($configuration);
    }
}