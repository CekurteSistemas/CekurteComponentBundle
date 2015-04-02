<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Serializer;

use Cekurte\ComponentBundle\Service\ServiceManager\ResourceInterface;

/**
 * Serializer Interface
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface SerializerInterface
{
    /**
     * Encode a list of resources.
     *
     * @api
     *
     * @param  array $resources
     *
     * @return mixed
     */
    public function encodeResources(array $resources);

    /**
     * Encode a resource.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     *
     * @return mixed
     */
    public function encodeResource(ResourceInterface $resource);

    /**
     * Decode a list of resources.
     *
     * @api
     *
     * @param  array $resources
     *
     * @return array
     */
    public function decodeResources(array $resources);

    /**
     * Decode a resource.
     *
     * @api
     *
     * @param  mixed $resource
     *
     * @return ResourceInterface
     */
    public function decodeResource($resource);
}
