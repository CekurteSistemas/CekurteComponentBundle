<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Doctrine;

/**
 * Repository Interface
 * 
 * @author João Paulo Cercal <sistemas@cekurte.com>
 * @version 1.0
 */
interface RepositoryInterface
{
    /**
     * Get a Entity Repository instance.
     *
     * @param string      $persistentObjectName
     * @param string|null $persistentManagerName
     *
     * @return mixed
     */
    public function getEntityRepository($persistentObjectName, $persistentManagerName = null);
}
