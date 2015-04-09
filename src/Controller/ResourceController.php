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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @inheritdoc
     */
    public function getSerializer()
    {
        if (!$this->container->has('jms_serializer')) {
            throw new \LogicException('The JMSSerializerBundle is not registered in your application.');
        }

        return $this->container->get('jms_serializer');
    }

    /**
     * @inheritdoc
     */
    public function getValidator()
    {
        if (!$this->container->has('validator')) {
            throw new \LogicException('The Validator is not registered in your application.');
        }

        return $this->container->get('validator');
    }

    /**
     * @inheritdoc
     */
    public function getRequestedDataAs(Request $request, $type)
    {
        $serializer = $this->getSerializer();

        try {
            return $serializer->deserialize($request->getContent(), $type, $request->getContentType());
        } catch (\Exception $e) {
            throw new ResourceDeserializeDataException($e->getMessage(), $e);
        }
    }

    /**
     * @inheritdoc
     */
    public function resourceIsValid(ResourceInterface $resource, $constraints = null, $groups = null)
    {
        $errors = $this->getValidator()->validate($resource, $constraints, $groups);

        if (count($errors) > 0) {
            throw new ResourceValidationErrorException((string) $errors);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function renderSerializedResponseToOperation($operation)
    {
        if (!in_array($operation = strtolower($operation), array('write', 'update', 'delete'))) {
            throw new \InvalidArgumentException(
                sprintf('The operation %s is not permitted. The operation must be: write, update or delete.', $operation
            ));
        }

        if ($operation === 'write') {
            $messagePart = 'written';
            $statusCode  = Response::HTTP_CREATED;
        } else {
            $messagePart = $operation;
            $statusCode  = Response::HTTP_OK;
        }

        $data = array(
            'message' => sprintf('The resource was %s with successfully!', $messagePart)
        );

        return new SerializedResponse($data, $statusCode);
    }
}
