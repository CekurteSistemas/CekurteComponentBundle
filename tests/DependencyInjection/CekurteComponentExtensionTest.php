<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\DependencyInjection;

use Cekurte\ComponentBundle\DependencyInjection\CekurteComponentExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CekurteComponentExtensionTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class CekurteComponentExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $configuration;

    /**
     * Assert parameter
     *
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->configuration->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    /**
     * Assert has definition
     *
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    public function setUp()
    {
        $this->configuration = new ContainerBuilder();

        $loader = new CekurteComponentExtension();

        $loader->load(array(), $this->configuration);
    }

    public function testLoadParameterServiceDoctrineResourceManagerClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager'));

        $this->assertParameter(
            'Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager',
            'cekurte_component.service.resource_manager.doctrine.class'
        );
    }

    public function testLoadParameterTwigExtensionRouteInfoClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Twig\\Extension\\RouteInfoExtension'));

        $this->assertParameter(
            'Cekurte\\ComponentBundle\\Twig\\Extension\\RouteInfoExtension',
            'cekurte_component.twig.extension.route_info.class'
        );
    }

    public function testLoadParameterTwigExtensionSecurityRoleClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Twig\\Extension\\SecurityRoleExtension'));

        $this->assertParameter(
            'Cekurte\\ComponentBundle\\Twig\\Extension\\SecurityRoleExtension',
            'cekurte_component.twig.extension.security_role.class'
        );
    }

    public function testLoadParameterEventListenerResponseClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\EventListener\\ResponseListener'));

        $this->assertParameter(
            'Cekurte\\ComponentBundle\\EventListener\\ResponseListener',
            'cekurte_component.event_listener.response.class'
        );
    }

    public function testLoadParameterEventListenerExceptionClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\EventListener\\ExceptionListener'));

        $this->assertParameter(
            'Cekurte\\ComponentBundle\\EventListener\\ExceptionListener',
            'cekurte_component.event_listener.exception.class'
        );
    }

    public function testLoadHasDefinitionTwigExtensionRouteInfoClass()
    {
        $this->assertHasDefinition(
            'cekurte_component.twig.extension.route_info'
        );
    }

    public function testLoadHasDefinitionTwigExtensionSecurityRoleClass()
    {
        $this->assertHasDefinition(
            'cekurte_component.twig.extension.security_role'
        );
    }

    public function testLoadHasDefinitionEventListenerResponseClass()
    {
        $this->assertHasDefinition(
            'cekurte_component.event_listener.response'
        );
    }

    public function testLoadHasDefinitionEventListenerExceptionClass()
    {
        $this->assertHasDefinition(
            'cekurte_component.event_listener.exception'
        );
    }

    public function testLoadDefinitionTwigExtensionRouteInfoClass()
    {
        $definition = $this->configuration->getDefinition('cekurte_component.twig.extension.route_info');

        $this->assertEquals('%cekurte_component.twig.extension.route_info.class%', $definition->getClass());

        $this->assertTrue($definition->hasTag('twig.extension'));

        $this->assertTrue($definition->hasMethodCall('setContainer'));

        $methodCalls = $definition->getMethodCalls();

        /** @var Reference $reference */
        $reference = $methodCalls[0][1][0];

        $this->assertEquals('service_container', (string) $reference);
    }

    public function testLoadDefinitionTwigExtensionSecurityRoleClass()
    {
        $definition = $this->configuration->getDefinition('cekurte_component.twig.extension.security_role');

        $this->assertEquals('%cekurte_component.twig.extension.security_role.class%', $definition->getClass());

        $this->assertTrue($definition->hasTag('twig.extension'));

        $this->assertTrue($definition->hasMethodCall('setContainer'));

        $methodCalls = $definition->getMethodCalls();

        /** @var Reference $reference */
        $reference = $methodCalls[0][1][0];

        $this->assertEquals('service_container', (string) $reference);
    }

    public function testLoadDefinitionEventListenerResponseClass()
    {
        $definition = $this->configuration->getDefinition('cekurte_component.event_listener.response');

        $this->assertEquals('%cekurte_component.event_listener.response.class%', $definition->getClass());

        $this->assertTrue($definition->hasTag('kernel.event_subscriber'));

        /** @var Reference $reference */
        $reference = $definition->getArgument(0);

        $this->assertEquals('jms_serializer', (string) $reference);
    }

    public function testLoadDefinitionEventListenerExceptionClass()
    {
        $definition = $this->configuration->getDefinition('cekurte_component.event_listener.exception');

        $this->assertEquals('%cekurte_component.event_listener.exception.class%', $definition->getClass());

        $this->assertTrue($definition->hasTag('kernel.event_subscriber'));
    }
}
