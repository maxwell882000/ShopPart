<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\CustomInstallment\Entities\CustomPlasticCardInstallment;
use App\Domain\Installment\Services\PlasticCardTakenCreditService;

class CustomPlasticCardInstalmentService extends PlasticCardTakenCreditService
{
    public function getEntity(): Entity
    {
        return CustomPlasticCardInstallment::new();
    }
}
