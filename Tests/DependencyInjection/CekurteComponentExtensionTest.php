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

    public function setUp()
    {
        $this->configuration = new ContainerBuilder();

        $loader = new CekurteComponentExtension();

        $loader->load(array(), $this->configuration);
    }

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

    public function testLoadHasParameterControllerHttpRestControllerClass()
    {
        $this->assertParameter(
            'Cekurte\ComponentBundle\Controller\Http\Rest\Controller',
            'cekurte_component.controller.http.rest.class'
        );
    }
}
