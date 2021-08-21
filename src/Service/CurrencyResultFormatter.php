<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Dto\Currency;

class CurrencyResultFormatter
{
    public function format(Currency $currency): array
    {
        $name = $currency->getName();
        $value = $currency->getValue();
        $postfix = $this->getPostfix($value);

        $resultString = "1 $name равен $value $postfix";

        return [
            $currency->getCode() => $resultString,
        ];
    }

    /**
     * Если в числе есть дробная часть, то существительным управляет она - "Равен десяти целым пяти десятым РУБЛЯМ"
     * Если дробной части нет, то существительное склоняется для чисел, заканчивающимся на единицу, кроме 11 - "Равен двадцати одному РУБЛЮ"
     */
    private function getPostfix(float $value): string
    {
        $postfix = 'рублям';
        $hasFraction = $value - floor($value);

        if (!$hasFraction && ($value % 100 !== 11) && (int)$value % 10 === 1) {
            $postfix = 'рублю';
        }

        return $postfix;
    }
}
