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
 * Class DoctrineContainerAwareTraitTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class DoctrineContainerAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testIsTrait()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\DoctrineContainerAwareTrait'
        );

        $this->assertTrue($reflection->isTrait());
    }

    public function testDoctrineTrait()
    {
        $mock = $this->getMockForTrait(
            '\\Cekurte\\ComponentBundle\\DependencyInjection\\ContainerAware\\DoctrineContainerAwareTrait',
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

        $doctrine = $this
            ->getMockBuilder('\\Doctrine\\Bundle\\DoctrineBundle\\Registry')
            ->setMethods(array('getManager'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $manager = $this
            ->getMockBuilder('\\Doctrine\\Common\\Persistence\\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $repository = $this
            ->getMockBuilder('\\Doctrine\\Common\\Persistence\\ObjectRepository')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $manager
            ->expects($this->any())
            ->method('getRepository')
            ->withAnyParameters()
            ->will($this->returnValue($repository))
        ;

        $doctrine
            ->expects($this->any())
            ->method('getManager')
            ->withAnyParameters()
            ->will($this->returnValue($manager))
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
            ->will($this->returnValue($doctrine))
        ;

        $mock
            ->expects($this->any())
            ->method('getContainer')
            ->will($this->returnValue($container))
        ;

        $this->assertInstanceOf(
            '\\Doctrine\\Bundle\\DoctrineBundle\\Registry',
            $mock->getDoctrine()
        );

        $this->assertInstanceOf(
            '\\Doctrine\\Common\\Persistence\\ObjectManager',
            $mock->getEntityManager()
        );

        $this->assertInstanceOf(
            '\\Doctrine\\Common\\Persistence\\ObjectRepository',
            $mock->getRepository('')
        );
    }
}
