<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExchangeService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class CurrencyExchangeController implements ApiKeyAuthenticatedController
{
    private ExchangeService $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * @Rest\Get("/exchange/{currencyCode}", name="exchange_currency")
     */
    public function exchangeCurrency(string $currencyCode): Response
    {
        try {
            $currency = $this->exchangeService->getCurrencyByCode($currencyCode);
        } catch (Throwable $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return new JsonResponse($currency);
    }

    /**
     * @Rest\Get("/exchange", name="exchange")
     */
    public function exchange(): Response
    {
        try {
            $currency = $this->exchangeService->getRandomCurrency();
        } catch (Throwable $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return new JsonResponse($currency);
    }
}
