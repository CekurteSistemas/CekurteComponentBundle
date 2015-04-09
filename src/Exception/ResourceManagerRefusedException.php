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
 * ResourceManagerRefusedException
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceManagerRefusedException extends ResourceException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = "", $code = ResourceException::RESOURCE_MANAGER_REFUSED_ERROR_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
