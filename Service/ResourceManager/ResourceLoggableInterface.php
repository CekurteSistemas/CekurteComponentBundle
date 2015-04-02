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

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * Get a loggable resource given the resource.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function getLoggableResource(ResourceInterface $resource);
}
