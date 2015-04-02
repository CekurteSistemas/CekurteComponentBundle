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

use Cekurte\ComponentBundle\DependencyInjection\ContainerAware\DoctrineContainerAwareTrait;
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Doctrine ResourceManager
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class DoctrineResourceManager implements ResourceManagerInterface
{
    use DoctrineContainerAwareTrait;

     /**
      * @var string
      */
    protected $resourceClassName;

     /**
      * Init
      *
      * @param EntityManagerInterface $entityManager
      * @param string                 $resourceClassName
      */
    public function __construct(EntityManagerInterface $entityManager, $resourceClassName)
    {
        $this->setEntityManager($entityManager);

        $this->setResourceClassName($resourceClassName);
    }

    /**
     * Set a resource class name.
     *
     * @param string $resourceClassName
     */
    protected function setResourceClassName($resourceClassName)
    {
        if (!is_string($resourceClassName)) {
            throw new \InvalidArgumentException('The resource class name could be a string.');
        }

        if (empty($resourceClassName)) {
            throw new \InvalidArgumentException('The resource class name could not be empty.');
        }

        $this->resourceClassName = $resourceClassName;
    }

    /**
     * Get the resource class name.
     *
     * @return string
     */
    public function getResourceClassName()
    {
        return $this->resourceClassName;
    }

    /**
     * @inheritdoc
     */
    public function getResource(array $parameters)
    {
        return $this->findResource($parameters);
    }

    /**
     * @inheritdoc
     */
    public function getResources(array $parameters = array())
    {

    }

    /**
     * @inheritdoc
     */
    public function getLoggableResource(ResourceInterface $resource)
    {

    }

    /**
     * @inheritdoc
     */
    public function findResource(array $parameters)
    {
        $resource = $this->getRepository($this->getResourceClassName())->findOneBy($parameters);

        if (!$resource) {

            throw new NotFoundHttpException(sprintf(
                'The resource "%s" was not found. Filter conditions: "%s" with values "%s"',
                $this->getResourceClassName(),
                implode(', ', array_keys($parameters)),
                implode(', ', array_values($parameters))
            ));
        }

        return $resource;
    }

    /**
     * @inheritdoc
     */
    public function findResources(array $parameters = array())
    {

    }

    /**
     * @inheritdoc
     */
    public function writeResource(array $parameters)
    {

    }

    /**
     * @inheritdoc
     */
    public function updateResource(ResourceInterface $resource, array $parameters)
    {

    }

    /**
     * @inheritdoc
     */
    public function deleteResource(ResourceInterface $resource)
    {

    }
}
