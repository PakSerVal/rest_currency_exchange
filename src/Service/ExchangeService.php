<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CurrencyRepositoryInterface;
use RuntimeException;

class ExchangeService
{
    private CurrencyRepositoryInterface $currencyRepository;
    private CurrencyResultFormatter $currencyResultFormatter;

    public function __construct(
        CurrencyRepositoryInterface $apiRatesRepository,
        CurrencyResultFormatter $currencyResultFormatter
    ) {
        $this->currencyRepository = $apiRatesRepository;
        $this->currencyResultFormatter = $currencyResultFormatter;
    }

    public function getCurrencyByCode(string $currencyCode): array
    {
        $currency = $this->currencyRepository->findByCode($currencyCode);
        if (!$currency) {
            throw new RuntimeException('Invalid currency name');
        }

        return $this->currencyResultFormatter->format($currency);
    }

    public function getRandomCurrency(): array
    {
        $all = $this->currencyRepository->findAll();

        if (empty($all)) {
            throw new RuntimeException('Empty currency list');
        }

        $currency = $all[array_rand($all)];

        return $this->currencyResultFormatter->format($currency);
    }
}
