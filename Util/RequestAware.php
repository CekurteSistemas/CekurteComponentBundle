<?php

namespace Cekurte\ComponentBundle\Util;

/**
 * RequestAware
 *
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
class RequestAware extends SessionAware
{
    /**
     * Shortcut to return the Request instance.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
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
