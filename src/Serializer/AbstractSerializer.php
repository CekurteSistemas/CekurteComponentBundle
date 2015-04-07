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

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface as JMSSerializerInterface;

/**
 * Abstract Serializer
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
abstract class AbstractSerializer implements SerializerInterface
{
    /**
     * @var JMSSerializerInterface
     */
    protected $serializer;

    /**
     * Get the format to serialize and deserialize.
     *
     * @return string
     *
     * @abstract
     */
    abstract public function getFormat();

    /**
     * Init
     *
     * @param JMSSerializerInterface $serializer
     */
    public function __construct(JMSSerializerInterface $serializer)
    {
        $this->setSerializer($serializer);
    }

    /**
     * Set a instance of Serializer.
     *
     * @param JMSSerializerInterface $serializer
     */
    protected function setSerializer(JMSSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Get a instance of Serializer.
     *
     * @return JMSSerializerInterface
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @inheritdoc
     */
    public function serialize($data, SerializationContext $context = null)
    {
        return $this->getSerializer()->serialize($data, $this->getFormat(), $context);
    }

    /**
     * @inheritdoc
     */
    public function deserialize($data, $type, DeserializationContext $context = null)
    {
        return $this->getSerializer()->deserialize($data, $type, $this->getFormat(), $context);
    }
}
