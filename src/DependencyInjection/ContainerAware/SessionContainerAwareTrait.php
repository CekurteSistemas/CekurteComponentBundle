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

/**
 * Session ContainerAware Trait
 *
 * Use this trait with @see \Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait SessionContainerAwareTrait
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
