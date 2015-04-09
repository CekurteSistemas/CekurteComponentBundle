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

use Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware;
use Cekurte\ComponentBundle\DependencyInjection\ContainerAware\DoctrineContainerAwareTrait;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedDeleteException;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedGetLogException;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedUpdateException;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedWriteException;
use Cekurte\ComponentBundle\Exception\ResourceNotFoundException;
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Doctrine ResourceManager
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class DoctrineResourceManager extends AbstractContainerAware implements ResourceManagerInterface
{
    use DoctrineContainerAwareTrait;

     /**
      * @var string
      */
    protected $resourceClassName;

     /**
      * Init
      *
      * @param ContainerInterface $container
      * @param string             $resourceClassName
      */
    public function __construct(ContainerInterface $container, $resourceClassName)
    {
        $this->setContainer($container);

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
    public function getLogEntries(ResourceInterface $resource)
    {
        try {
            return $this->getRepository('\Gedmo\Loggable\Entity\LogEntry')->getLogEntries($resource);
        } catch (\Exception $e) {
            throw new ResourceManagerRefusedGetLogException($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function findResource(array $parameters)
    {
        $resource = $this->getRepository($this->getResourceClassName())->findOneBy($parameters);

        if (!$resource) {
            throw new ResourceNotFoundException(sprintf(
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
        return $this->getRepository($this->getResourceClassName())->findBy($parameters);
    }

    /**
     * @inheritdoc
     */
    public function writeResource(ResourceInterface $resource)
    {
        try {
            $this->getEntityManager()->persist($resource);
            $this->getEntityManager()->flush();

            return true;
        } catch (\Exception $e) {
            throw new ResourceManagerRefusedWriteException($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function updateResource(ResourceInterface $resource)
    {
        try {
            $this->getEntityManager()->persist($resource);
            $this->getEntityManager()->flush();

            return true;
        } catch (\Exception $e) {
            throw new ResourceManagerRefusedUpdateException($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteResource(ResourceInterface $resource)
    {
        try {
            $this->getEntityManager()->remove($resource);
            $this->getEntityManager()->flush();

            return true;
        } catch (\Exception $e) {
            throw new ResourceManagerRefusedDeleteException($e->getMessage());
        }
    }
}
