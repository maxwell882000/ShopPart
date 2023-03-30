<?php

namespace App\Domain\Installment\CustomInstallment\Builders;

use App\Domain\Installment\Builders\PlasticTakenCreditBuilder;

class CustomPlasticCardInstallmentBuilder extends PlasticTakenCreditBuilder
{
    protected function parentTable():string
    {
        return "custom_plastic";
    }
}
