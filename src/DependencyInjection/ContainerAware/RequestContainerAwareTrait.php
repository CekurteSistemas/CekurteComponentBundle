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
 * Request ContainerAware Trait
 *
 * Use this trait with @see \Cekurte\ComponentBundle\DependencyInjection\ContainerAware\AbstractContainerAware
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
trait RequestContainerAwareTrait
{
    /**
     * Shortcut to return the Request instance.
     *
     * @return \Symfony\Component\HttpFoundation\Request
     *
     * @throws \LogicException
     */
    public function getRequest()
    {
        if (!$this->getContainer()->has('request')) {
            throw new \LogicException('The Request is not registered in your application.');
        }

        return $this->getContainer()->get('request');
    }
}
