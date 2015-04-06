<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Container Aware Extension
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 *
 * @abstract
 */
abstract class AbstractContainerAwareExtension extends \Twig_Extension
{
    use ContainerAwareTrait;

    /**
     * Get a instance of ContainerInterface.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
