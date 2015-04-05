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

use Cekurte\ComponentBundle\Controller\Http\RestController;
use Cekurte\ComponentBundle\Controller\Http\RestControllerInterface;

/**
 * Class RestControllerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class RestControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RestControllerInterface
     */
    private $controller;

    public function setUp()
    {
        $serializer = $this
            ->getMockBuilder('\\Cekurte\ComponentBundle\Serializer\\SerializerInterface')
            ->getMock()
        ;

        $resourceManager = $this
            ->getMockBuilder('\\Cekurte\ComponentBundle\Service\\ResourceManagerInterface')
            ->getMock()
        ;

        $this->controller = new RestController($serializer, $resourceManager);
    }

    public function testInstanceOfGetSerializer()
    {
        $this->assertInstanceOf(
            '\\Cekurte\ComponentBundle\Serializer\\SerializerInterface',
            $this->controller->getSerializer()
        );
    }

    public function testInstanceOfGetResourceManager()
    {
        $this->assertInstanceOf(
            '\\Cekurte\ComponentBundle\Service\\ResourceManagerInterface',
            $this->controller->getResourceManager()
        );
    }

    public function testInheritedOfSymfonyDefaultController()
    {
        $this->assertInstanceOf(
            '\\Symfony\Bundle\FrameworkBundle\Controller\\Controller',
            $this->controller
        );
    }
}
