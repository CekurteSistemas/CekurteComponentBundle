<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\ComponentBundle\EventListener;

use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * ResponseListener
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ResponseListener implements EventSubscriberInterface
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Init
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::RESPONSE   => 'onKernelResponse',
        );
    }

    /**
     * Get a instance of Serializer.
     *
     * @return SerializerInterface
     */
    protected function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * Modify the Response given the Request if the Response is a instance of SerializedResponse.
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();

        if ($response instanceof SerializedResponse) {
            $acceptableContentTypes = $event->getRequest()->getAcceptableContentTypes();

            $format = 'json';

            foreach ($acceptableContentTypes as $item) {
                if (strpos($item, 'xml') !== false) {
                    $format = 'xml';
                    break;
                }
            }

            $serializedData = $this->serializer->serialize($response->getData(), $format, null);

            $response->setContent($serializedData);
        }
    }
}
