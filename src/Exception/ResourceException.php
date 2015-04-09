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
 * ResourceException
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceException extends \Exception
{
    /**
     * @var int
     */
    const RESOURCE_ERROR_CODE = 10;

    /**
     * @var int
     */
    const RESOURCE_MANAGER_REFUSED_ERROR_CODE = 100;

    /**
     * @var int
     */
    const RESOURCE_MANAGER_REFUSED_WRITE_ERROR_CODE = 110;

    /**
     * @var int
     */
    const RESOURCE_MANAGER_REFUSED_UPDATE_ERROR_CODE = 120;

    /**
     * @var int
     */
    const RESOURCE_MANAGER_REFUSED_DELETE_ERROR_CODE = 130;

    /**
     * @var int
     */
    const RESOURCE_MANAGER_REFUSED_GETLOG_ERROR_CODE = 140;

    /**
     * @var int
     */
    const RESOURCE_SERIALIZE_ERROR_CODE = 200;

    /**
     * @var int
     */
    const RESOURCE_SERIALIZE_DATA_ERROR_CODE = 210;

    /**
     * @var int
     */
    const RESOURCE_DESERIALIZE_DATA_ERROR_CODE = 220;

    /**
     * @var int
     */
    const RESOURCE_NOTFOUND_ERROR_CODE = 440;

    /**
     * @var int
     */
    const RESOURCE_VALIDATION_ERROR_CODE = 450;

    /**
     * @inheritdoc
     */
    public function __construct($message = "", $code = self::RESOURCE_ERROR_CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
