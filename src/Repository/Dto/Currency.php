<?php

declare(strict_types=1);

namespace App\Repository\Dto;

class Currency
{
    private string $code;
    private string $name;
    private float $value;

    public function __construct(string $code, string $name, float $value)
    {
        $this->code = $code;
        $this->name = $name;
        $this->value = $value;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
