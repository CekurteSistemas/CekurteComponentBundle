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

/**
 * Class YamlSerializerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class YamlSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfAbstractSerializer()
    {
        $serializer = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Serializer\\YamlSerializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer',
            $serializer
        );
    }

    public function testMethodGetFormat()
    {
        $serializer = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Serializer\\YamlSerializer')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $this->assertEquals('yaml', $serializer->getFormat());
    }
}
