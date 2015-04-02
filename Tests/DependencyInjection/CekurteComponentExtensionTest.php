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

    public function testLoadParameterControllerHttpRestClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Controller\\Http\\RestController'));

        $this->assertParameter(
            'Cekurte\ComponentBundle\Controller\Http\RestController',
            'cekurte_component.controller.http.rest.class'
        );
    }

    public function testLoadParameterJsonSerializerClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Serializer\\JsonSerializer'));

        $this->assertParameter(
            'Cekurte\ComponentBundle\Serializer\JsonSerializer',
            'cekurte_component.serializer.json.class'
        );
    }

    public function testLoadParameterServiceDoctrineResourceManagerClass()
    {
        $this->assertTrue(class_exists('\\Cekurte\\ComponentBundle\\Service\\ResourceManager\\DoctrineResourceManager'));

        $this->assertParameter(
            'Cekurte\ComponentBundle\Service\ResourceManager\DoctrineResourceManager',
            'cekurte_component.service.resource_manager.doctrine.class'
        );
    }

    public function testLoadHasDefinitionJsonSerializerClass()
    {
        $this->assertHasDefinition(
            'cekurte_component.serializer.json'
        );
    }

    public function testLoadDefinitionJsonSerializerClass()
    {
        $definition = $this->configuration->getDefinition('cekurte_component.serializer.json');

        $this->assertEquals('%cekurte_component.serializer.json.class%', $definition->getClass());
    }
}
