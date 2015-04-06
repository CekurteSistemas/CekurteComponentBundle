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

/**
 * Class AbstractContainerAwareExtensionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class AbstractContainerAwareExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testClassIsAbstract()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\Twig\\Extension\\AbstractContainerAwareExtension'
        );

        $this->assertTrue($reflection->isAbstract());
    }

    public function testInstanceOfTwigExtension()
    {
        $extension = $this
            ->getMockForAbstractClass('\\Cekurte\\ComponentBundle\\Twig\\Extension\\AbstractContainerAwareExtension')
        ;

        $this->assertInstanceOf('\\Twig_Extension', $extension);
    }

    public function testMethodSetAndGetContainer()
    {
        $container = $this
            ->getMockBuilder('\\Symfony\\Component\\DependencyInjection\\Container')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $extension = $this
            ->getMockForAbstractClass('\\Cekurte\\ComponentBundle\\Twig\\Extension\\AbstractContainerAwareExtension')
        ;

        $extension->setContainer($container);

        $this->assertInstanceOf(
            '\\Symfony\\Component\\DependencyInjection\\ContainerInterface',
            $extension->getContainer()
        );
    }
}
