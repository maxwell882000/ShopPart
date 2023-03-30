<?php

namespace App\Domain\Installment\Schedule;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Installment\Jobs\MonthPaidJobs;
use App\Domain\Installment\Jobs\PennyPaidJobs;
use App\Domain\Installment\Payable\MonthPaidPayable;
use App\Domain\Installment\Payable\PennyPayble;

class InstallmentCheckForPenny extends AbstractSchedule
{
    const PAYABLE = PennyPayble::class;
    const JOBS = PennyPaidJobs::class;

    public function call()
    {
        return parent::call()->daily();
    }

    public function run()
    {
        // after everyday we will try o
        $payable = static::PAYABLE;
        $payable::unpaid()->chunk(500, function ($penny_pay) {
            foreach ($penny_pay as $penny) {
                $jobs = static::JOBS;
                $jobs::dispatch($penny);
            }
        });

    }
}
