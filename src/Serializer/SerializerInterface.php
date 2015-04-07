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

use JMS\Serializer\SerializationContext;
use JMS\Serializer\DeserializationContext;

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
     * @var string
     */
    const FORMAT_JSON = 'json';

    /**
     * @var string
     */
    const FORMAT_XML = 'xml';

    /**
     * @var string
     */
    const FORMAT_YAML = 'yaml';

    /**
     * Serializes the given data to the specified output format.
     *
     * @param object|array|scalar  $data
     * @param SerializationContext $context
     *
     * @return string
     */
    public function serialize($data, SerializationContext $context = null);

    /**
     * Deserializes the given data to the specified type.
     *
     * @param string                 $data
     * @param string                 $type
     * @param DeserializationContext $context
     *
     * @return object|array|scalar
     */
    public function deserialize($data, $type, DeserializationContext $context = null);
}
