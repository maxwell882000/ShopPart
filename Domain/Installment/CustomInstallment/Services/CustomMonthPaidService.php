<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\CustomInstallment\Entities\CustomMonthPaid;
use App\Domain\Installment\Services\MonthPaidService;

class CustomMonthPaidService extends MonthPaidService
{
    public function getEntity(): Entity
    {
        return CustomMonthPaid::new();
    }
}
