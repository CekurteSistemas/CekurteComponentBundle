<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\Serializer;

use Cekurte\ComponentBundle\Serializer\JsonSerializer;

/**
 * Class JsonSerializerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class JsonSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializerDataArray()
    {
        $data = array(
            'id'   => 1,
            'name' => 'Cercal',
        );

        $serializer = new JsonSerializer();

        $this->assertEquals(
            json_encode($data),
            $serializedData = $serializer->serialize($data)
        );

        $this->assertEquals(
            $data,
            $serializer->deserialize($serializedData, 'array')
        );
    }
}
