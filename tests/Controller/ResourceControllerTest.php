<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\Controller;

use Cekurte\ComponentBundle\Controller\ResourceController;

/**
 * Class ResourceControllerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResourceControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceController
     */
    private $controller;

    public function setUp()
    {
        $resourceManager = $this
            ->getMockBuilder('\\Cekurte\\ComponentBundle\\Service\\ResourceManagerInterface')
            ->getMock()
        ;

        $this->controller = new ResourceController($resourceManager);
    }

    public function testInheritedOfSymfonyDefaultController()
    {
        $this->assertInstanceOf(
            '\\Symfony\\Bundle\\FrameworkBundle\\Controller\\Controller',
            $this->controller
        );
    }

    public function testImplementsInterfaceResourceControllerInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Controller\\ResourceController'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\ComponentBundle\\Controller\\ResourceControllerInterface'
        ));
    }

    public function testGetResourceManager()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Service\\ResourceManagerInterface',
            $this->controller->getResourceManager()
        );
    }

    public function testgetSerializer()
    {
        $serializer = $this
            ->getMockBuilder('\\JMS\\Serializer\\Serializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $container = $this
            ->getMockBuilder('\\Symfony\\Component\\DependencyInjection\\Container')
            ->setMethods(array('has', 'get'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $container
            ->expects($this->any())
            ->method('has')
            ->withAnyParameters()
            ->will($this->returnValue(true))
        ;

        $container
            ->expects($this->any())
            ->method('get')
            ->withAnyParameters()
            ->will($this->returnValue($serializer))
        ;

        $this->controller->setContainer($container);

        $this->assertInstanceOf(
            '\\JMS\\Serializer\\SerializerInterface',
            $this->controller->getSerializer()
        );
    }
}
