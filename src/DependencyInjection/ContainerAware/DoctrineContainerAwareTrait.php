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
 * Use this trait with @see \Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait DoctrineContainerAwareTrait
{
    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     *
     * @throws \LogicException
     */
    public function getDoctrine()
    {
        if (!$this->getContainer()->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->getContainer()->get('doctrine');
    }

    /**
     * Get a instance of Entity Manager.
     *
     * @param string|null $name
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getEntityManager($name = null)
    {
        return $this->getDoctrine()->getManager($name);
    }

    /**
     * Gets the repository for a class.
     *
     * @param string      $className
     * @param string|null $entityManagerName
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($className, $entityManagerName = null)
    {
        return $this->getEntityManager($entityManagerName)->getRepository($className);
    }
}
