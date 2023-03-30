<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\TimeScheduleTransactionBuilder;
use App\Domain\Installment\CustomInstallment\Builders\CustomTimeScheduleBuilder;
use App\Domain\Installment\Entities\TimeScheduleTransactions;

class CustomTimeSchedule extends TimeScheduleTransactions
{
    protected $table = "custom_time_schedule_transactions";

    public function newEloquentBuilder($query): TimeScheduleTransactionBuilder
    {
        return new CustomTimeScheduleBuilder($query);
    }
}
