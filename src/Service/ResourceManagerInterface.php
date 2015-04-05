<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Service;

use Cekurte\ComponentBundle\Service\ResourceManager\ResourceDeletableInterface;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceInterface;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceLoggableInterface;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceSearchableInterface;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceUpdatableInterface;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceWritableInterface;

/**
 * ResourceManager Interface
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceManagerInterface extends
    ResourceInterface,
    ResourceLoggableInterface,
    ResourceSearchableInterface,
    ResourceWritableInterface,
    ResourceUpdatableInterface,
    ResourceDeletableInterface
{
}
