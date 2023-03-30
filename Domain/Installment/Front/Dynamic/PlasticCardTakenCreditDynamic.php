<?php

namespace App\Domain\Installment\Front\Dynamic;

use App\Domain\Installment\Entities\PlasticCardTakenCredit;
use App\Domain\Installment\Services\PlasticCardTakenCreditService;
use App\Domain\User\Front\Admin\CustomTable\Tables\PlasticDynamicTable;
use App\Domain\User\Front\Traits\PlasticCardDynamic;

class PlasticCardTakenCreditDynamic extends PlasticCardTakenCredit
{
    use PlasticCardDynamic;

    public function getTableClass(): string
    {
        return  PlasticDynamicTable::class;
    }
    public static function getDynamicParentKey(): string
    {
        return  "taken_credit_id";
    }

    public static function getBaseService():string
    {
        return PlasticCardTakenCreditService::class;
    }
}
