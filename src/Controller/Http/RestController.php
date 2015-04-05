<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Controller\Http;

use Cekurte\ComponentBundle\Serializer\SerializerInterface;
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * RestController
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class RestController extends Controller implements RestControllerInterface
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ResourceManagerInterface
     */
    protected $resourceManager;

    /**
     * Init
     *
     * @param SerializerInterface      $serializer
     * @param ResourceManagerInterface $resourceManager
     */
    public function __construct(SerializerInterface $serializer, ResourceManagerInterface $resourceManager)
    {
        $this->serializer      = $serializer;
        $this->resourceManager = $resourceManager;
    }

    /**
     * @inheritdoc
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @inheritdoc
     */
    public function getResourceManager()
    {
        return $this->resourceManager;
    }
}
