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
 * User ContainerAware Trait
 *
 * Use this trait with @see \Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware
 * 
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait UserContainerAwareTrait
{
    /**
     * Get a user from the Security Context.
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see    \Symfony\Component\Security\Core\Authentication\Token\TokenInterface::getUser()
     */
    public function getUser()
    {
        if (!$this->getContainer()->has('security.context')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->getContainer()->get('security.context')->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }
}
