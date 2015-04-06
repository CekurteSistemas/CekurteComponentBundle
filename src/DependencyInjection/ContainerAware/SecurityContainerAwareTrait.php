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
 * Security ContainerAware Trait
 *
 * Use this trait with @see \Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait SecurityContainerAwareTrait
{
    /**
     * Get the Security Context.
     *
     * @return \Symfony\Component\Security\Core\SecurityContext
     *
     * @throws \LogicException If SecurityBundle is not available
     */
    public function getSecurityContext()
    {
        if (!$this->getContainer()->has('security.context')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->getContainer()->get('security.context');
    }

    /**
     * Get a user from the Security Context.
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     */
    public function getUser()
    {
        if (null === $token = $this->getSecurityContext()->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }
}
