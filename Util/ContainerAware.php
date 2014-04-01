<?php

namespace Cekurte\ComponentBundle\Util;

use Symfony\Component\DependencyInjection\ContainerAware as SymfonyContainerAware;

/**
 * ContainerAware
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class ContainerAware extends SymfonyContainerAware
{
    /**
     * Get a instance of ContainerInterface.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Get a user from the Security Context
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see \Symfony\Component\Security\Core\Authentication\Token\TokenInterface::getUser()
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
