<?php

declare(strict_types=1);

namespace App\Repository\Dto;

use DateTime;
use JMS\Serializer\Annotation as Serializer;

class ApiCurrenciesResponseData
{
    /**
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("Date")
     */
    public DateTime $date;
    /**
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("PreviousDate")
     */
    public DateTime $previousDate;
    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PreviousURL")
     */
    public string $previousUrl;
    /**
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("Timestamp")
     */
    public DateTime $timestamp;
    /**
     * @Serializer\Type("array<string, App\Repository\Dto\ApiValuteResponse>")
     * @Serializer\SerializedName("Valute")
     */
    public array $valutes;
}
