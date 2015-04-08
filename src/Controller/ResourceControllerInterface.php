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

/**
 * ResourceController Interface
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceControllerInterface
{
    /**
     * Get a instance of Resource Manager
     *
     * @return ResourceManagerInterface
     */
    public function getResourceManager();


    /**
     * Get a instance of JMS Serializer.
     *
     * @throws \LogicException
     *
     * @return SerializerInterface
     */
    public function getSerializer();
}
