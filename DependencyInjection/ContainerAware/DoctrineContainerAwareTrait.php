<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\DependencyInjection\ContainerAware;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Doctrine ContainerAware Trait
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait DoctrineContainerAwareTrait
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Set a instance of EntityManager
     *
     * @param EntityManagerInterface $entityManager
     */
    public function setEntityManager(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get a instance of EntityManager
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Gets the repository for a class.
     *
     * @param string $className
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($className)
    {
        return $this->getEntityManager()->getRepository($className);
    }
}
