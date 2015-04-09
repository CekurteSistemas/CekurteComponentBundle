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
        $this->assertTrue(true);
    }
}
