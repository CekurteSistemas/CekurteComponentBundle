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
 * ResourceSearchable Interface
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceSearchableInterface extends ResourceInterface
{
    /**
     * Find a resource given the parameters.
     *
     * @api
     *
     * @param  array $parameters
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function findResource(array $parameters);

    /**
     * Find the resources given the parameters.
     *
     * @api
     *
     * @param  array $parameters
     *
     * @return array
     */
    public function findResources(array $parameters = array());
}
