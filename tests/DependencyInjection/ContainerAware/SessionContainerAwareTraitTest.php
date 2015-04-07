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

use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

/**
 * Class SessionContainerAwareTraitTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SessionContainerAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testIsTrait()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\SessionContainerAwareTrait'
        );

        $this->assertTrue($reflection->isTrait());
    }

    public function testSessionTrait()
    {
        $mock = $this->getMockForTrait(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\SessionContainerAwareTrait',
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

        $session = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Session\\Session')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $flashBag = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $session
            ->expects($this->any())
            ->method('getFlashBag')
            ->withAnyParameters()
            ->will($this->returnValue($flashBag))
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
            ->will($this->returnValue($session))
        ;

        $mock
            ->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($container))
        ;

        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Session\\Session',
            $mock->getSession()
        );

        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            $mock->getSession()->getFlashBag()
        );
    }
}
