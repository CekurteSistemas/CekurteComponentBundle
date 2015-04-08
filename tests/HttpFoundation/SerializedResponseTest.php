<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\HttpFoundation;

use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;

/**
 * Class SerializedResponseTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class SerializedResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritedOfSymfonyDefaultResponse()
    {
        $response = new SerializedResponse(array());

        $this->assertInstanceOf(
            '\\Symfony\\Component\\HttpFoundation\\Response',
            $response
        );
    }

    public function testContructor()
    {
        $response = new SerializedResponse(array(), 201, array('Custom' => 'fake'));

        $this->assertEquals(array(), $response->getData());

        $this->assertEquals(201, $response->getStatusCode());

        $this->assertEquals('fake', $response->headers->get('Custom'));
    }

    public function testSetData()
    {
        $response = new SerializedResponse(array());

        $class  = new \ReflectionClass($response);
        $method = $class->getMethod('setData');

        $method->setAccessible(true);

        $method->invokeArgs($response, array(array('fakeData' => true)));

        $data = $response->getData();

        $this->assertArrayHasKey('fakeData', $data);

        $this->assertTrue($data['fakeData']);
    }

    public function testGetData()
    {
        $response = new SerializedResponse(array('fake'));

        $this->assertEquals(array('fake'), $response->getData());
    }
}
