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

/**
 * Dispatcher
 */
class Dispatcher
{
    /**
     * Executes the dispatcher
     *
     * @param array $content Not used
     * @param array $configuration TypoScript configuration
     * @return string The rendered view
     */
    public function execute($content, $configuration)
    {
        return $this->dispatch();
    }

    /**
     * Dispatch
     *
     * @return string The rendered view
     */
    protected function dispatch()
    {
        $output = 'Dispatch';

        return $output;
    }
}