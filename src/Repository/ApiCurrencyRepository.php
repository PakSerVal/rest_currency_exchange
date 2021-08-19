<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\Dto\ApiCurrenciesResponseData;
use App\Repository\Dto\ApiValuteResponse;
use App\Repository\Dto\Currency;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class ApiCurrencyRepository implements CurrencyRepositoryInterface
{
    private ClientInterface $httpClient;
    private Serializer $serializer;

    public function __construct(ClientInterface $client, SerializerBuilder $serializerBuilder)
    {
        $this->httpClient = $client;
        $this->serializer = $serializerBuilder->build();
    }

    /**
     * @throws GuzzleException
     */
    public function findByCode(string $currencyCode): ?Currency
    {
        $response = $this->doRequest();
        /** @var ApiValuteResponse $apiValute */
        foreach ($response->valutes as $apiCurrencyCode => $apiValute) {
            if ($apiCurrencyCode === $currencyCode) {
                return new Currency($apiCurrencyCode, $apiValute->name, $apiValute->value);
            }
        }

        return null;
    }

    /**
     * @throws GuzzleException
     */
    public function findAll(): array
    {
        $result = [];
        $response = $this->doRequest();

        /** @var ApiValuteResponse $apiValute */
        foreach ($response->valutes as $apiCurrencyCode => $apiValute) {
            $result[] = new Currency($apiCurrencyCode, $apiValute->name, $apiValute->value);
        }

        return $result;
    }

    /**
     * @throws GuzzleException
     */
    private function doRequest(): ApiCurrenciesResponseData
    {
        $content = $this->httpClient->request('GET')->getBody()->getContents();

        return $this->serializer->deserialize($content, ApiCurrenciesResponseData::class, 'json');
    }
}
