<?php

namespace Cekurte\ComponentBundle\Util;

/**
 * SessionContainerAware
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class SessionContainerAware extends DoctrineContainerAware
{
    /**
     * Shortcut to return the Session instance.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     *
     * @throws \LogicException
     */
    public function getSession()
    {
        if (!$this->getContainer()->has('session')) {
            throw new \LogicException('The Session is not registered in your application.');
        }

        return $this->getContainer()->get('session');
    }

    /**
     * Shortcut to return the FlashBag instance.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     */
    public function getFlashBag()
    {
        return $this->getSession()->getFlashBag();
    }
}
