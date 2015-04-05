<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Service\ResourceManager;

/**
 * ResourceLoggable Interface
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceLoggableInterface extends ResourceInterface
{
    /**
     * Get all logs entries given the resource.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     *
     * @return array
     */
    public function getLogEntries(ResourceInterface $resource);
}
