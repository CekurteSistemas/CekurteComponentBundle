<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Controller;

use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ResourceController
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceController extends Controller implements ResourceControllerInterface
{
    /**
     * @var ResourceManagerInterface
     */
    protected $resourceManager;

    /**
     * Init
     *
     * @param ResourceManagerInterface $resourceManager
     */
    public function __construct(ResourceManagerInterface $resourceManager)
    {
        $this->resourceManager = $resourceManager;
    }

    /**
     * @inheritdoc
     */
    public function getResourceManager()
    {
        return $this->resourceManager;
    }

    /**
     * Get a instance of JMS Serializer.
     *
     * @throws \LogicException
     *
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        if (!$this->container->has('jms_serializer')) {
            throw new \LogicException('The JMSSerializerBundle is not registered in your application.');
        }

        return $this->container->get('jms_serializer');
    }
}
