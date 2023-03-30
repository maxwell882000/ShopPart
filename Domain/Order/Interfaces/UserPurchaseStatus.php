<?php

namespace App\Domain\Order\Interfaces;

interface UserPurchaseStatus
{
    const CASH = 1;
    const CARD = 2;
    const INSTANCE_PAYMENT = 100;
    const INSTALMENT = 201;//cannot have cash
    const DELIVERY = 10;
    const SELF_DELIVERY = 20;
    const CASH_AND_SELF_DELIVERY = self::CASH + self::SELF_DELIVERY;
    const INSTANCE_PAYMENT_AND_SELF_DELIVERY = self::INSTANCE_PAYMENT + self::SELF_DELIVERY;
    const INSTALMENT_AND_SELF_DELIVERY = self::INSTALMENT + self::SELF_DELIVERY;
    const CASH_AND_DELIVERY = self::CASH + self::DELIVERY;
    const INSTANCE_PAYMENT_AND_DELIVERY = self::INSTANCE_PAYMENT + self::DELIVERY;
    const INSTALMENT_AND_DELIVERY = self::INSTALMENT + self::DELIVERY;

    const TYPE_OF_PURCHASE = [
        self::INSTALMENT - 1 => "Рассрочка",
        self::INSTANCE_PAYMENT => "Быстрая покупка"
    ];
}
