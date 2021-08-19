<?php

declare(strict_types=1);

namespace App\Repository\Dto;

use JMS\Serializer\Annotation as Serializer;

class ApiValuteResponse
{
    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ID")
     */
    public string $id;
    /**
     * @Serializer\Type("int")
     * @Serializer\SerializedName("NumCode")
     */
    public int $numCode;
    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CharCode")
     */
    public string $charCode;
    /**
     * @Serializer\Type("int")
     * @Serializer\SerializedName("Nominal")
     */
    public int $nominal;
    /**
     * @Serializer\Type("string")
     * @Serializer\SerializedName("Name")
     */
    public string $name;
    /**
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Value")
     */
    public float $value;
    /**
     * @Serializer\Type("float")
     * @Serializer\SerializedName("Previous")
     */
    public float $previous;
}
