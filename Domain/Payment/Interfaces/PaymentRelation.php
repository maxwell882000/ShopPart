<?php

namespace App\Domain\Payment\Interfaces;

use App\Domain\User\Interfaces\UserRelationInterface;

interface PaymentRelation extends PaymentStatus
{
    const USER_SERVICE = "user";
    const CARD_SERVICE = "card";
    const PLASTIC_SERVICE = "plastic";
    const USER_TO = "user" . \CR::CR;
    const CARD_TO = "card" . \CR::CR;
    const PURCHASE_SERVICE = "purchase";
    const PURCHASE_TO = self::PURCHASE_SERVICE . \CR::CR;
    const USER_TO_USER_DATA = self::USER_TO . UserRelationInterface::USER_DATA;
    const USER_TO_CRUCIAL_DATA = self::USER_TO . UserRelationInterface::CRUCIAL_DATA;
    const PLASTIC_TO = self::CARD_TO . self::PLASTIC_SERVICE . \CR::CR;
}
