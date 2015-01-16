<?php

namespace Cekurte\ComponentBundle\Entity;

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
     * @param string $persistentObjectName
     * @param string|null $persistentManagerName
     *
     * @return mixed
     */
    public function getEntityRepository($persistentObjectName, $persistentManagerName = null);
}
