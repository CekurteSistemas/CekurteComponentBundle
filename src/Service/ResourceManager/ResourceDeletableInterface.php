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

use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedDeleteException;

/**
 * ResourceDeletable Interface
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
interface ResourceDeletableInterface extends ResourceInterface
{
    /**
     * Delete the resource(s) given the parameters.
     *
     * @api
     *
     * @param  ResourceInterface $resource
     *
     * @return bool
     *
     * @throws ResourceManagerRefusedDeleteException
     */
    public function deleteResource(ResourceInterface $resource);
}
