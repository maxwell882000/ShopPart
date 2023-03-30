<?php

namespace App\Domain\Installment\CustomInstallment\Builders;

use App\Domain\Installment\Builders\TakenCreditBuilder;

class CustomInstallmentBuilder extends TakenCreditBuilder
{
    protected function getSearch(): string
    {
        return "contract_num";
    }

    protected function ownTable()
    {
        return "custom_installment";
    }

    protected function monthPaidTable()
    {
        return "custom_month_paid";
    }
}
