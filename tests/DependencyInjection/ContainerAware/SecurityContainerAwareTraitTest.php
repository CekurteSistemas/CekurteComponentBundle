<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\DependencyInjection\ContainerAware;

/**
 * Class SecurityContainerAwareTraitTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SecurityContainerAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testUserTrait()
    {
        $mock = $this->getMockForTrait(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\SecurityContainerAwareTrait',
            array(),
            '',
            true,
            true,
            true,
            array('getContainer'),
            false
        );

        $container = $this
            ->getMockBuilder('\\Symfony\\Component\\DependencyInjection\\Container')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $token = $this
            ->getMockBuilder('FakeTokenInterface')
            ->setMethods(array('getToken'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $user = $this
            ->getMockBuilder('FakeUserInterface')
            ->setMethods(array('getUser'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $container
            ->expects($this->any())
            ->method('has')
            ->withAnyParameters()
            ->will($this->returnValue(true))
        ;

        $user
            ->expects($this->any())
            ->method('getUser')
            ->withAnyParameters()
            ->will($this->returnValue(new \stdClass()))
        ;

        $token
            ->expects($this->any())
            ->method('getToken')
            ->withAnyParameters()
            ->will($this->returnValue($user))
        ;

        $container
            ->expects($this->any())
            ->method('get')
            ->withAnyParameters()
            ->will($this->returnValue($token))
        ;

        $mock
            ->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($container))
        ;

        $this->assertEquals(new \stdClass(), $mock->getUser());
    }
}
