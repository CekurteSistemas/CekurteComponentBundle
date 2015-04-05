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

/**
 * RestController Interface
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface RestControllerInterface
{
    /**
     * Get a instance of Serializer
     *
     * @return SerializerInterface
     */
    public function getSerializer();

    /**
     * Get a instance of Resource Manager
     *
     * @return ResourceManagerInterface
     */
    public function getResourceManager();
}
