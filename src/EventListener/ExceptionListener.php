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

use Cekurte\ComponentBundle\Exception\ResourceDeserializeDataException;
use Cekurte\ComponentBundle\Exception\ResourceException;
use Cekurte\ComponentBundle\Exception\ResourceManagerRefusedException;
use Cekurte\ComponentBundle\Exception\ResourceNotFoundException;
use Cekurte\ComponentBundle\Exception\ResourceValidationErrorException;
use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * ExceptionListener
 *
 * @author João Paulo Cercal <jpcercal@gmail.com>
 *
 * @version 2.0
 */
class ExceptionListener implements EventSubscriberInterface
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION   => 'onKernelException',
        );
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof ResourceValidationErrorException) {
            return $event->setResponse(new SerializedResponse(array(
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ), Response::HTTP_BAD_REQUEST));
        }

        if ($exception instanceof ResourceNotFoundException) {
            return $event->setResponse(new SerializedResponse(array(
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ), Response::HTTP_NOT_FOUND));
        }

        if ($exception instanceof ResourceDeserializeDataException) {
            return $event->setResponse(new SerializedResponse(array(
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ), Response::HTTP_BAD_REQUEST));
        }

        if ($exception instanceof ResourceManagerRefusedException) {
            return $event->setResponse(new SerializedResponse(array(
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage(),
            ), Response::HTTP_BAD_REQUEST));
        }
    }
}
