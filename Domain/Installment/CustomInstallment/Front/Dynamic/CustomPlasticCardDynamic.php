<?php

namespace App\Domain\Installment\CustomInstallment\Front\Dynamic;

use App\Domain\Installment\CustomInstallment\Builders\CustomPlasticCardInstallmentBuilder;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Services\CustomPlasticCardInstalmentService;
use App\Domain\Installment\Front\Dynamic\PlasticCardTakenCreditDynamic;

class CustomPlasticCardDynamic extends PlasticCardTakenCreditDynamic
{
    protected const BUILDER = CustomPlasticCardInstallmentBuilder::class;
    protected const INSTALLMENT = CustomInstallment::class;
    protected const PIVOT_TABLE = 'custom_plastic'; // for taken credit

    public static function getBaseService(): string
    {
        return CustomPlasticCardInstalmentService::class;
    }
}
