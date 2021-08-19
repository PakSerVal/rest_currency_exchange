<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Repository\CurrencyRepositoryInterface;
use App\Repository\Dto\Currency;
use App\Service\CurrencyResultFormatter;
use App\Service\ExchangeService;
use Generator;
use Mockery;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @covers \App\Service\ExchangeService
 */
class ExchangeServiceTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSuccessGetCurrencyByCode(Currency $currency, string $expectedResult): void
    {
        $repository = Mockery::mock(CurrencyRepositoryInterface::class);
        $repository->shouldReceive('findByCode')->andReturn($currency);

        $service = new ExchangeService($repository, new CurrencyResultFormatter());

        $this->assertEquals($expectedResult, $service->getCurrencyByCode($currency->getCode()));
    }

    public function testFailedGetCurrencyByCode(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectErrorMessage('Invalid currency name');

        $repository = Mockery::mock(CurrencyRepositoryInterface::class);
        $repository->shouldReceive('findByCode')->andReturn(null);

        $service = new ExchangeService($repository, new CurrencyResultFormatter());

        $service->getCurrencyByCode('AAA');
    }

    public function dataProvider(): Generator
    {
        yield [
            'currency' => new Currency('CHF', 'Швейцарский франк', 80.9855),
            'expectedResult' => '1 Швейцарский франк равен 80.9855 рублям',
        ];

        yield [
            'currency' => new Currency('AUD', 'Австралийский доллар', 51.0),
            'expectedResult' => '1 Австралийский доллар равен 51 рублю',
        ];

        yield [
            'currency' => new Currency('PLN', 'Польский злотый', 0.0),
            'expectedResult' => '1 Польский злотый равен 0 рублям',
        ];

        yield [
            'currency' => new Currency('RON', 'Румынский лей', 100.0),
            'expectedResult' => '1 Румынский лей равен 100 рублям',
        ];
    }
}
