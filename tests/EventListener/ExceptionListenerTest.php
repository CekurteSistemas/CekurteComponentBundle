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

use Cekurte\ComponentBundle\EventListener\ExceptionListener;
use Cekurte\ComponentBundle\Exception\ResourceDeserializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedException;
use Cekurte\ComponentBundle\Exception\ResourceNotFoundException;
use Cekurte\ComponentBundle\Exception\ResourceSerializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceValidationErrorException;
use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ExceptionListenerTest
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ExceptionListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param  \Exception $exception
     *
     * @return GetResponseForExceptionEvent
     */
    protected function getEvent(\Exception $exception)
    {
        $kernel = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpKernel\\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $request = $this
            ->getMockBuilder('\\Symfony\\Component\\HttpFoundation\\Request')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return new GetResponseForExceptionEvent($kernel, $request, null, $exception);
    }

    public function testImplementsEventSubscriberInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\ComponentBundle\\EventListener\\ExceptionListener'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Symfony\\Component\\EventDispatcher\\EventSubscriberInterface'
        ));
    }

    public function testGetSubscribedEventsIsStaticMethod()
    {
        $reflection = new \ReflectionMethod(
            '\\Cekurte\\ComponentBundle\\EventListener\\ExceptionListener',
            'getSubscribedEvents'
        );

        $this->assertTrue($reflection->isStatic());
    }

    public function testGetSubscribedEvents()
    {
        $subscribedEvents = ExceptionListener::getSubscribedEvents();

        $this->assertArrayHasKey(KernelEvents::EXCEPTION, $subscribedEvents);

        $this->assertEquals('onKernelException', $subscribedEvents[KernelEvents::EXCEPTION]);
    }

    public function testOnKernelException()
    {
        $event = $this->getEvent(new \Exception());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertNull($event->getResponse());
    }

    public function testOnKernelExceptionCatchResourceValidationErrorException()
    {
        $event = $this->getEvent(new ResourceValidationErrorException());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\HttpFoundation\\SerializedResponse',
            $event->getResponse()
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $event->getResponse()->getStatusCode());
    }

    public function testOnKernelExceptionCatchResourceNotFoundException()
    {
        $event = $this->getEvent(new ResourceNotFoundException());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\HttpFoundation\\SerializedResponse',
            $event->getResponse()
        );

        $this->assertEquals(Response::HTTP_NOT_FOUND, $event->getResponse()->getStatusCode());
    }

    public function testOnKernelExceptionCatchResourceSerializeDataException()
    {
        $event = $this->getEvent(new ResourceSerializeDataException());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\HttpFoundation\\SerializedResponse',
            $event->getResponse()
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $event->getResponse()->getStatusCode());
    }

    public function testOnKernelExceptionCatchResourceDeserializeDataException()
    {
        $event = $this->getEvent(new ResourceDeserializeDataException());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\HttpFoundation\\SerializedResponse',
            $event->getResponse()
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $event->getResponse()->getStatusCode());
    }

    public function testOnKernelExceptionCatchResourceManagerRefusedException()
    {
        $event = $this->getEvent(new ResourceManagerRefusedException());

        $listener = new ExceptionListener();

        $listener->onKernelException($event);

        $this->assertInstanceOf(
            '\\Cekurte\\ComponentBundle\\HttpFoundation\\SerializedResponse',
            $event->getResponse()
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $event->getResponse()->getStatusCode());
    }
}
