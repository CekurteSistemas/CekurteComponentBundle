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
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Doctrine ResourceManager
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 *
 * @abstract
 */
abstract class DoctrineResourceManager extends AbstractContainerAware implements ResourceManagerInterface
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
        return $this->getRepository('\Gedmo\Loggable\Entity\LogEntry')->getLogEntries($resource);
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
        return $this->getRepository($this->getResourceClassName())->findBy($parameters);
    }

    /**
     * @inheritdoc
     */
    public function writeResource(ResourceInterface $resource)
    {
        $this->getEntityManager()->persist($resource);
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function updateResource(ResourceInterface $resource)
    {
        $this->getEntityManager()->persist($resource);
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteResource(ResourceInterface $resource)
    {
        $this->getEntityManager()->remove($resource);
        $this->getEntityManager()->flush();

        return true;
    }
}
