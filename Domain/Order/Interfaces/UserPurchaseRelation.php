<?php

namespace App\Domain\Order\Interfaces;

use App\Domain\Delivery\Interfaces\DeliveryAddressRelation;

interface UserPurchaseRelation extends UserPurchaseStatus
{
    const PURCHASE_SERVICE = "purchases";
    const PURCHASE_TO = self::PURCHASE_SERVICE . \CR::CR;
    const PRODUCTS_ENCODE = "products_encoded";

    const DELIVERY_SERVICE = "delivery";
    const DELIVERY_ADDRESS_SERVICE = "delivery_address";
    const DELIVERY_TO = self::DELIVERY_SERVICE . \CR::CR;
    const DELIVERY_ADDRESS_TO = self::DELIVERY_ADDRESS_SERVICE . \CR::CR;
    const AVAILABLE_CITIES_TO = self::DELIVERY_ADDRESS_TO . DeliveryAddressRelation::AVAILABLE_CITIES_TO;
}
