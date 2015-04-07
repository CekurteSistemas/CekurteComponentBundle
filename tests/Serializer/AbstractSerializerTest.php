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
 * Class AbstractSerializerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class AbstractSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testClassIsAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer'
        );

        $this->assertTrue($reflection->isAbstract());
    }

    public function testClassImplementsInterfaceSerializer()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\ComponentBundle\\Serializer\\SerializerInterface'
        ));
    }

    public function testClassHasMethodAbstractGetFormat()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer'
        );

        $this->assertTrue($reflection->getMethod('getFormat')->isAbstract());
    }

    public function testClassMethodAbstractGetFormatIsPublic()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer'
        );

        $this->assertTrue($reflection->getMethod('getFormat')->isPublic());
    }

    public function testDependencyInjectionJMSSerializer()
    {
        $dependency = $this
            ->getMockBuilder('\\JMS\\Serializer\\Serializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $mock = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Serializer\\AbstractSerializer')
            ->setConstructorArgs(array($dependency))
            ->enableOriginalConstructor()
            ->getMockForAbstractClass()
        ;

        $this->assertInstanceOf(
            '\\JMS\\Serializer\\SerializerInterface',
            $mock->getSerializer()
        );
    }
}
