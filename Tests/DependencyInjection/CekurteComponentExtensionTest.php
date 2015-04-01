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

    public function testLoadHasParameterControllerHttpRestClass()
    {
        $this->assertParameter(
            'Cekurte\ComponentBundle\Controller\Http\Rest\Controller',
            'cekurte_component.controller.http.rest.class'
        );
    }

    public function testLoadHasParameterSerializerHttpRestClass()
    {
        $this->assertParameter(
            'Cekurte\ComponentBundle\Serializer\Http\Rest\Serializer',
            'cekurte_component.serializer.http.rest.class'
        );
    }

    public function testLoadHasParameterServiceHttpRestClass()
    {
        $this->assertParameter(
            'Cekurte\ComponentBundle\Service\Http\Rest\ServiceManager',
            'cekurte_component.service.http.rest.class'
        );
    }

    public function testLoadHasDefinitionControllerHttpRest()
    {
        $this->assertHasDefinition(
            'cekurte_component.controller.http.rest'
        );
    }

    public function testLoadHasDefinitionSerializerHttpRest()
    {
        $this->assertHasDefinition(
            'cekurte_component.serializer.http.rest'
        );
    }

    public function testLoadHasDefinitionServiceHttpRest()
    {
        $this->assertHasDefinition(
            'cekurte_component.service.http.rest'
        );
    }
}
