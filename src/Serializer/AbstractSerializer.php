<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Serializer;

use JMS\Serializer\SerializerBuilder;

/**
 * Abstract Serializer
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
abstract class AbstractSerializer
{
    /**
     * Get a instance of Serializer.
     *
     * @return \JMS\Serializer\Serializer
     */
    protected function getSerializer()
    {
        return SerializerBuilder::create()->build();
    }
}
