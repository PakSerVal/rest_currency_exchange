<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Dto\Currency;

interface CurrencyRepositoryInterface
{
    public function findByCode(string $currencyCode): ?Currency;
    public function findAll(): array;
}
