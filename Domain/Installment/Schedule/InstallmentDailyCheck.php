<?php

namespace App\Domain\Installment\Schedule;

use App\Domain\Core\BackgroundTask\Base\AbstractSchedule;
use App\Domain\Installment\Jobs\MonthPaidJobs;
use App\Domain\Installment\Payable\MonthPaidPayable;


class InstallmentDailyCheck extends AbstractSchedule
{
    const PAYABLE = MonthPaidPayable::class;
    const JOBS = MonthPaidJobs::class;

    public function call()
    {
        return parent::call()->daily();
    }

    public function run()
    {
        $payble = static::PAYABLE;
        $payble::unpaidForMonth()->chunk(500, function ($month_pay) {
            foreach ($month_pay as $pay) {
                $jobs = static::JOBS;
                $jobs::dispatch($pay);
            }
        });

    }
}
