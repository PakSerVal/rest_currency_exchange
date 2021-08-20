<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ExchangeService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class CurrencyExchangeController extends AbstractFOSRestController implements ApiKeyAuthenticatedController
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
            $view = View::create()
                ->setData($this->exchangeService->getCurrencyByCode($currencyCode));
        } catch (Throwable $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $this->getViewHandler()->handle($view);
    }

    /**
     * @Rest\Get("/exchange", name="exchange")
     */
    public function exchange(): Response
    {
        try {
            $view = View::create()
                ->setData($this->exchangeService->getRandomCurrency());
        } catch (Throwable $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        return $this->getViewHandler()->handle($view);
    }
}
