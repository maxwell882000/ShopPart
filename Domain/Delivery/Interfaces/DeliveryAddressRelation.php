<?php

namespace App\Domain\Delivery\Interfaces;

interface DeliveryAddressRelation
{
    const AVAILABLE_CITIES_SERVICE = "availableCities";
    const AVAILABLE_CITIES_TO = self::AVAILABLE_CITIES_SERVICE . \CR::CR;
}
