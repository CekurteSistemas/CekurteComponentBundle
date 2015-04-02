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
 * ResourceUpdatable Interface
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceUpdatableInterface extends ResourceInterface
{
    /**
     * Update the resource(s) given the parameters.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     * @param  array             $parameters
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function updateResource(ResourceInterface $resource, array $parameters);
}
