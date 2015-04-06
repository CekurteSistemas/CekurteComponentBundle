<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\Twig\Extension;

use Cekurte\ComponentBundle\Twig\Extension\RouteInfoExtension;

/**
 * Class RouteInfoExtensionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class RouteInfoExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RouteInfoExtension
     */
    private $extension;

    public function setUp()
    {
        $request = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Request')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $request
            ->expects($this->any())
            ->method('get')
            ->withAnyParameters()
            ->will($this->returnValue('Cekurte\ComponentFakeBundle\Controller\ComponentFakeController::fakeAction'))
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
            ->will($this->returnValue(true))
        ;

        $container
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($request))
        ;

        $this->extension = new RouteInfoExtension();

        $this->extension->setContainer($container);
    }

    public function testInstanceOfAbstractContainerAwareExtension()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Twig\\Extension\\AbstractContainerAwareExtension',
            $this->extension
        );
    }

    public function testGetRequestInstanceOf()
    {
        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Request',
            $this->extension->getRequest()
        );
    }

    public function testGetBundleName()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getBundleName');

        $method->setAccessible(true);

        $this->assertEquals(
            'Cekurte\ComponentFake',
            $method->invokeArgs($this->extension, array())
        );
    }

    public function testGetControllerName()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getControllerName');

        $method->setAccessible(true);

        $this->assertEquals(
            'ComponentFake',
            $method->invokeArgs($this->extension, array())
        );
    }

    public function testGetActionName()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getActionName');

        $method->setAccessible(true);

        $this->assertEquals(
            'fake',
            $method->invokeArgs($this->extension, array())
        );
    }

    public function testGetFunctions()
    {
        $functions = $this->extension->getFunctions();

        $this->assertArrayHasKey('cekurte_bundle_name', $functions);

        $this->assertArrayHasKey('cekurte_controller_name', $functions);

        $this->assertArrayHasKey('cekurte_action_name', $functions);
    }

    public function testGetName()
    {
        $this->assertEquals(
            'cekurte_route_info_extension',
            $this->extension->getName()
        );
    }
}
