<?php

namespace App\Domain\Core\BackgroundTask\Base;

use App\Domain\Core\BackgroundTask\Interfaces\ScheduleInterface;
use Illuminate\Console\Scheduling\Schedule;

abstract class AbstractSchedule implements ScheduleInterface
{
    protected Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function call()
    {
        return $this->schedule->call(function () {
            $this->run();
        });
    }

    final protected function dispatch($collection, string $job)
    {
        foreach ($collection->all() as $item) {
            $job::dispatch($item);
        }
    }

    final static public function schedule(Schedule $schedule)
    {
        $object = new static($schedule);
        $object->call()->sendOutputTo("/var/www/Shop/schedule.log");
    }
}
