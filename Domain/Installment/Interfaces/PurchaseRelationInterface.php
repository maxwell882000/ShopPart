<?php

namespace App\Domain\Installment\Interfaces;

use App\Domain\Order\Interfaces\UserPurchaseRelation;
use App\Domain\User\Interfaces\UserRelationInterface;

interface PurchaseRelationInterface extends PurchaseStatus
{
    const SURETY_SERVICE = "surety";
    const USER_SERVICE = "user";
    const USER_DATA_SERVICE = "userData";
    const PURCHASE_SERVICE = "purchase";
    const PLASTIC_CARD_SERVICE = "plastic";
    const CREDIT_SERVICE = "credit";
    const PLASTIC_CARD_TO = self::PLASTIC_CARD_SERVICE . \CR::CR;
    const CREDIT_TO = self::CREDIT_SERVICE . \CR::CR;
    const USER_DATA_TO = self::USER_DATA_SERVICE . \CR::CR;
    const CRUCIAL_DATA = self::USER_DATA_TO . UserRelationInterface::CRUCIAL_DATA_SERVICE;
    const CRUCIAL_DATA_TO = self::CRUCIAL_DATA  . \CR::CR;
    const USER_TO = self::USER_SERVICE . \CR::CR;
    const SURETY_TO = self::SURETY_SERVICE . \CR::CR;
    const SURETY_CRUCIAL_DATA_TO = self::SURETY_TO . UserRelationInterface::CRUCIAL_DATA_SERVICE . \CR::CR;
    const PURCHASE_TO = self::PURCHASE_SERVICE . \CR::CR;
    const DELIVERY_TO = self::PURCHASE_TO . UserPurchaseRelation::DELIVERY_SERVICE . "()" . \CR::CR;
    const DELIVERY_ADDRESS_TO = self::PURCHASE_TO . UserPurchaseRelation::DELIVERY_ADDRESS_TO;
    const AVAILABLE_CITIES_TO = self::PURCHASE_TO . UserPurchaseRelation::AVAILABLE_CITIES_TO;
    const PURCHASES_TO = self::PURCHASE_TO . UserPurchaseRelation::PURCHASE_TO;
}
