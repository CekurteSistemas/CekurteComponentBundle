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

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractContainerAwareTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class AbstractContainerAwareTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfSymfonyContainerAware()
    {
        $mock = $this->getMockForAbstractClass(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\AbstractContainerAware'
        );

        $this->assertInstanceOf(
            '\\Symfony\\Component\\DependencyInjection\\ContainerAware',
            $mock
        );
    }

    public function testInstanceOfGetContainer()
    {
        $mock = $this->getMockForAbstractClass(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\AbstractContainerAware'
        );

        $container = $this
            ->getMockBuilder('\\Symfony\\Component\\DependencyInjection\\Container')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $mock->setContainer($container);

        $this->assertEquals($container, $mock->getContainer());
    }
}
