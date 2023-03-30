<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Installment\CustomInstallment\Entities\CustomTimeSchedule;
use App\Domain\Installment\Services\TimeScheduleService;

class CustomTimeScheduleService extends TimeScheduleService
{
    const TIME_SCHEDULE_CLASS = CustomTimeSchedule::class;
}
