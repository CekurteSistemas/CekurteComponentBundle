<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\Tests\EventListener;

use Cekurte\ComponentBundle\EventListener\ResponseListener;
use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ResponseListenerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResponseListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsEventSubscriberInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\EventListener\\ResponseListener'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Symfony\\Component\\EventDispatcher\\EventSubscriberInterface'
        ));
    }

    public function testGetSerializer()
    {
        $serializer = $this
            ->getMockBuilder('\\JMS\\Serializer\\Serializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $listener = new ResponseListener($serializer);

        $class  = new \ReflectionClass($listener);
        $method = $class->getMethod('getSerializer');

        $method->setAccessible(true);

        $this->assertInstanceOf(
            '\\JMS\\Serializer\\SerializerInterface',
            $method->invokeArgs($listener, array())
        );
    }

    public function testGetSubscribedEventsIsStaticMethod()
    {
        $reflection = new \ReflectionMethod(
            '\\Cekurte\\ComponentBundle\\EventListener\\ResponseListener',
            'getSubscribedEvents'
        );

        $this->assertTrue($reflection->isStatic());
    }

    public function testGetSubscribedEvents()
    {
        $subscribedEvents = ResponseListener::getSubscribedEvents();

        $this->assertArrayHasKey(KernelEvents::RESPONSE, $subscribedEvents);

        $this->assertEquals('onKernelResponse', $subscribedEvents[KernelEvents::RESPONSE]);
    }

    public function testOnKernelResponse()
    {
        $response = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Response')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $event = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpKernel\\Event\\FilterResponseEvent')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $event
            ->expects($this->any())
            ->method('getResponse')
            ->will($this->returnValue($response))
        ;

        $serializer = $this
            ->getMockBuilder('\\JMS\\Serializer\\Serializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $listener = new ResponseListener($serializer);

        $listener->onKernelResponse($event);

        $this->assertEmpty($response->getContent());
    }

    public function testOnKernelResponseIsInstanceOfSerializedResponse()
    {
        $response = new SerializedResponse('');

        $request = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Request')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $request
            ->expects($this->any())
            ->method('getAcceptableContentTypes')
            ->will($this->returnValue(array()))
        ;

        $event = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpKernel\\Event\\FilterResponseEvent')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $event
            ->expects($this->any())
            ->method('getResponse')
            ->will($this->returnValue($response))
        ;

        $event
            ->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($request))
        ;

        $serializer = $this
            ->getMockBuilder('\\JMS\\Serializer\\Serializer')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $serializer
            ->expects($this->any())
            ->method('serialize')
            ->will($this->returnValue('{"Fake": "Data"}'))
        ;

        $listener = new ResponseListener($serializer);

        $listener->onKernelResponse($event);

        $this->assertEquals(
            '{"Fake": "Data"}',
            $event->getResponse()->getContent()
        );
    }
}
