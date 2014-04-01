<?php

namespace Cekurte\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Cekurte\ComponentBundle\Util\SessionContainerAware;

/**
 * Custom of Symfony Controller.
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
abstract class Controller extends SymfonyController
{
    /**
     * Get a SessionContainerAware instance
     *
     * @return SessionContainerAware
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * {@inherited}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = new SessionContainerAware($container);
    }
}
