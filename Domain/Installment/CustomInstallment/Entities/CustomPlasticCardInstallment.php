<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\PlasticTakenCreditBuilder;
use App\Domain\Installment\CustomInstallment\Builders\CustomPlasticCardInstallmentBuilder;
use App\Domain\Installment\Entities\PlasticCardTakenCredit;
use App\Domain\Installment\Entities\TakenCredit;

class CustomPlasticCardInstallment extends PlasticCardTakenCredit
{
    protected const BUILDER = CustomPlasticCardInstallmentBuilder::class;
    protected const INSTALLMENT = CustomInstallment::class;
    protected const PIVOT_TABLE = 'custom_plastic'; // for taken credit
}
