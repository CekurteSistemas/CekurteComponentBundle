<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Exception;

/**
 * ResourceManagerRefusedWriteException
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceManagerRefusedWriteException extends ResourceManagerRefusedException
{
    /**
     * Init.
     *
     * @param string     $message
     * @param \Exception $previous
     */
    public function __construct($message = "", \Exception $previous = null)
    {
        parent::__construct($message, ResourceException::RESOURCE_MANAGER_REFUSED_WRITE_ERROR_CODE, $previous);
    }
}
