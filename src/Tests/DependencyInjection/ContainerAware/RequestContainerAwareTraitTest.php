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
 * Class RequestContainerAwareTraitTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class RequestContainerAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testRequestTrait()
    {
        $mock = $this->getMockForTrait(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\RequestContainerAwareTrait',
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

        $request = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Request')
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
            ->will($this->returnValue($request))
        ;

        $mock
            ->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($container))
        ;

        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Request',
            $mock->getRequest()
        );
    }
}
