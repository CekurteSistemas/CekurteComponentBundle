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

use Cekurte\ComponentBundle\Exception\ResourceDeserializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceValidationErrorException;
use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceInterface;
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * Get a instance of Resource Manager.
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

    /**
     * Get a instance of Symfony Validator Component.
     *
     * @throws \LogicException
     *
     * @return ValidatorInterface
     */
    public function getValidator();

    /**
     * Get the requested data given the $type.
     *
     * @param  Request $request
     * @param  string  $type
     *
     * @throws ResourceDeserializeDataException
     *
     * @return mixed
     */
    public function getRequestedDataAs(Request $request, $type);

    /**
     * Checks if the resource is valid.
     *
     * @param  ResourceInterface $resource
     * @param  Constraint        $constraints
     * @param  array|null        $groups
     *
     * @throws ResourceValidationErrorException
     * @throws \LogicException
     *
     * @return bool
     */
    public function resourceIsValid(ResourceInterface $resource, $constraints = null, $groups = null);

    /**
     * Render the default Response message given the operation.
     *
     * @param  string $operation
     *
     * @throws \InvalidArgumentException
     *
     * @return SerializedResponse
     */
    public function renderSerializedResponseToOperation($operation);
}
