<?php

namespace Cekurte\ComponentBundle\Util;

use Cekurte\ComponentBundle\Entity\RepositoryInterface;

/**
 * DoctrineContainerAware
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class DoctrineContainerAware extends ContainerAware implements RepositoryInterface
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
     * Get a instance of Entity Manager
     *
     * @param string|null $name
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getManager($name = null)
    {
        return $this->getDoctrine()->getManager($name);
    }

    /**
     * @inheritdoc
     */
    public function getEntityRepository($persistentObjectName, $persistentManagerName = null)
    {
        return $this->getDoctrine()->getRepository($persistentObjectName, $persistentManagerName);
    }
}
