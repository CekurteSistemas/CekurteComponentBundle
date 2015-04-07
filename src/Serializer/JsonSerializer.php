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

/**
 * JSON Serializer
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class JsonSerializer extends AbstractSerializer
{
    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        return 'json';
    }
}
