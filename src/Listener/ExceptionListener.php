<?php

declare(strict_types=1);

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpException) {
            $event->setResponse(new JsonResponse([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]));
        }
    }
}
