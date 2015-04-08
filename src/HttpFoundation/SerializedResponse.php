<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;

/**
 * SerializedResponse
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SerializedResponse extends Response
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * Create a Serialized Response.
     *
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     */
    public function __construct($data, $status = 200, $headers = array())
    {
        parent::__construct('', $status, $headers);

        $this->setData($data);
    }

    /**
     * Set the data.
     *
     * @param mixed $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get the data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
