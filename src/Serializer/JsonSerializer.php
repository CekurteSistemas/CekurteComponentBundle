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

use Cekurte\ComponentBundle\Service\ResourceManager\ResourceInterface;

/**
 * JSON Serializer
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class JsonSerializer implements SerializerInterface
{
    /**
     * @inheritdoc
     */
    public function encodeResources(array $resources)
    {
        return;
    }

    /**
     * @inheritdoc
     */
    public function encodeResource(ResourceInterface $resource)
    {
        return;
    }

    /**
     * @inheritdoc
     */
    public function decodeResources(array $resources)
    {
        return;
    }

    /**
     * @inheritdoc
     */
    public function decodeResource($resource)
    {
        return;
    }
}
