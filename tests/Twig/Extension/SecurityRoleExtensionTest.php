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

use Cekurte\ComponentBundle\Twig\Extension\SecurityRoleExtension;

/**
 * Class SecurityRoleExtensionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SecurityRoleExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RouteInfoExtension
     */
    private $extension;

    public function setUp()
    {
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
            ->will($this->returnCallback(array($this, 'containerGet')))
        ;

        $this->extension = new SecurityRoleExtension();

        $this->extension->setContainer($container);
    }

    public function containerGet()
    {
        $args = func_get_args();

        if ($args[0] === 'security.context') {
            $securityContext = $this
                ->getMockBuilder('\\Symfony\\Component\\Security\\Core\\SecurityContext')
                ->disableOriginalConstructor()
                ->getMock()
            ;

            $securityContext
                ->expects($this->any())
                ->method('isGranted')
                ->will($this->returnCallback(function () {

                    $role = func_get_arg(0);

                    if (in_array($role, array('ROLE_CEKURTECOMPONENTFAKE_COMPONENTFAKE', 'ROLE_SUPER_ADMIN'))) {
                        return true;
                    }

                    return false;
                }))
            ;

            return $securityContext;
        } elseif ($args[0] === 'request') {
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

            return $request;
        }
    }

    public function testInstanceOfRouteInfoExtension()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\Twig\\Extension\\RouteInfoExtension',
            $this->extension
        );
    }

    public function testGetSecurityContextInstanceOf()
    {
        $this->assertInstanceOf(
            '\\Symfony\\Component\\Security\\Core\\SecurityContext',
            $this->extension->getSecurityContext()
        );
    }

    public function testGetSecurityRoleAdmin()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getSecurityRoleAdmin');

        $method->setAccessible(true);

        $this->assertEquals(
            'ROLE_ADMIN',
            $method->invokeArgs($this->extension, array())
        );
    }

    public function testGetSpecificRoleSuffix()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getSpecificRoleSuffix');

        $method->setAccessible(true);

        $this->assertEquals(
            '',
            $method->invokeArgs($this->extension, array(''))
        );

        $this->assertEquals(
            '',
            $method->invokeArgs($this->extension, array('list'))
        );

        $this->assertEquals(
            '',
            $method->invokeArgs($this->extension, array('List'))
        );

        $this->assertEquals(
            '',
            $method->invokeArgs($this->extension, array('LIST'))
        );

        $this->assertEquals(
            '_OTHER',
            $method->invokeArgs($this->extension, array('other'))
        );

        $this->assertEquals(
            '_OTHER',
            $method->invokeArgs($this->extension, array('Other'))
        );

        $this->assertEquals(
            '_OTHER',
            $method->invokeArgs($this->extension, array('OTHER'))
        );
    }

    public function testGetFormattedSpecificRole()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('getSpecificRoleFormatted');

        $method->setAccessible(true);

        $roles = array('list', 'List', 'LIST');

        foreach ($roles as $role) {
            $this->assertEquals(
                'ROLE_CEKURTECOMPONENTFAKE_COMPONENTFAKE',
                $method->invokeArgs($this->extension, array($role))
            );
        }

        $roles = array('retrieve', 'Retrieve', 'RETRIEVE');

        foreach ($roles as $role) {
            $this->assertEquals(
                'ROLE_CEKURTECOMPONENTFAKE_COMPONENTFAKE_RETRIEVE',
                $method->invokeArgs($this->extension, array($role))
            );
        }
    }

    public function testIsGrantedFalse()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('isGranted');

        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($this->extension, array('RETRIEVE')));
    }

    public function testIsGrantedTrue()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('isGranted');

        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->extension, array('LIST')));
    }

    public function testIsGrantedTrueAsSuperAdmin()
    {
        $class  = new \ReflectionClass($this->extension);
        $method = $class->getMethod('isGranted');

        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->extension, array('OTHER', 'ROLE_SUPER_ADMIN')));
    }

    public function testGetFunctions()
    {
        $functions = $this->extension->getFunctions();

        $this->assertArrayHasKey('cekurte_is_granted', $functions);
    }

    public function testGetName()
    {
        $this->assertEquals(
            'cekurte_security_role_extension',
            $this->extension->getName()
        );
    }
}
