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
 * ResourceWritable Interface
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceWritableInterface extends ResourceInterface
{
    /**
     * Write a resource given the resource.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function writeResource(ResourceInterface $resource);
}