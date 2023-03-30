<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\TimeScheduleTransactionBuilder;

class TimeScheduleTransactions extends Entity
{
    protected $table = "time_schedule_transactions";
    public $timestamps = true;
    public function newEloquentBuilder($query): TimeScheduleTransactionBuilder
    {
        return new TimeScheduleTransactionBuilder($query);
    }
}
