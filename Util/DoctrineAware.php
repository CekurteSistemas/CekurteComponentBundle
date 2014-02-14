<?php

namespace Cekurte\ComponentBundle\Util;

/**
 * DoctrineAware
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class DoctrineAware extends ContainerAware
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
     * @return \Doctrine\ORM\EntityManager
     */
    public function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Get a instance of Entity Repository
     *
     * @return mixed
     */
    public function getRepository($name)
    {
        return $this->getManager()->getRepository($name);
    }
}
