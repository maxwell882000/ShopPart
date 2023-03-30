<?php

namespace App\Domain\Core\BackgroundTask\Interfaces;

use App\Domain\Core\Language\Traits\Translatable;
use Illuminate\Console\Scheduling\Schedule;

interface ScheduleInterface
{
    static public function schedule(Schedule $schedule);

    public function run();

    public function call();
}
