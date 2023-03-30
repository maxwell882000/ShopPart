<?php

namespace App\Domain\Shop\Interfaces;

interface   ShopRelationInterface
{
    const SHOP_ADDRESS = 'shopAddress';
    const WORK_TIME = 'workTime';
    const DELIVERY_ADDRESS = 'delivery';
    const CITIES = "availableCities";
    const USER = "user";
    const SHOP_ADDRESS_TO = self::SHOP_ADDRESS . \CR::CR;
    const ADDRESS_TO_WORK_TIME_TO = self::SHOP_ADDRESS_TO . self::WORK_TIME;
    const ADDRESS_TO_DELIVERY_TO = self::SHOP_ADDRESS_TO . self::DELIVERY_ADDRESS . \CR::CR;
    const DELIVERY_TO_CITIES_TO = self::ADDRESS_TO_DELIVERY_TO . self::CITIES . \CR::CR;
    const USER_TO = self::USER . \CR::CR;
}
