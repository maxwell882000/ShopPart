<?php

namespace App\Domain\Installment\Jobs;

use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Api\CardService\Model\WithdrawMoney;
use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Installment\Interfaces\MonthPayableInterface;
use App\Domain\Installment\Services\TimeScheduleService;
use App\Domain\User\Entities\PlasticCard;
use Illuminate\Support\Facades\Log;

// check how it is working
class MonthPaidJobs extends AbstractJob
{
    protected MonthPayableInterface $monthPaid;
    protected WithdrawMoney $withdrawMoney;
    protected $time_service;

    public function __construct(MonthPayableInterface $monthPaid)
    {
        $this->monthPaid = $monthPaid;
        $this->time_service = $this->timeService();
    }

    protected function timeService(): string
    {
        return TimeScheduleService::class;
    }

    protected function failedClass()
    {
        return FailedToWithdraw::class;
    }

    /// handle logic when it goes to FailedToWithdraw dispatch
    ///  what has to be the condition for this case
    public function withdraw()
    {
        $is_paid = false;
        foreach ($this->monthPaid->getTokens() as $token) {
            $pan = PlasticCard::byToken($token)->first()->pan;
            try {
                if ($is_paid = $this->withdrawMoney->withdraw($token)) {
                    Log::info("SUCCESS PAIDDD");
                    $this->time_service::success($pan, $this->monthPaid->getTakenCreditId());
                    break;
                }
            } catch (CardServiceError $exception) {
                echo "CAUGHT ERRORS";
                Log::info("ERRORR!!!!!");
                $this->caughtException($exception, $pan);
            }
        }
        if (!$is_paid) {
            $this->unpaidAction();
        }
    }
  // we create fail to widthdraw , if we cannot withdraw money
    protected function unpaidAction()
    {
        $this->time_service::failedAll($this->monthPaid->getTakenCreditId());
        $failed = $this->failedClass();
        $class_entity = get_class($this->monthPaid);
        $failed::dispatch($class_entity::find($this->monthPaid->id));
    }

    protected function caughtException(CardServiceError $exception, $pan)
    {

        $this->time_service::failed($pan,
            $exception->getMessage(),
            $this->monthPaid->getTakenCreditId());
    }

    public function handle()
    {
//        echo "STARTED TO WORK!!!";
        Log::info("STARTED TO WORK!!!");
        echo "STARTED WORK";
        try {
        Log::info($this->monthPaid);
        $this->withdrawMoney = new WithdrawMoney($this->monthPaid);
        $this->withdraw();
        } catch (\Throwable $exception) {
            echo "WAS ERROR";
            Log::error($exception->getMessage());
            Log::error($exception->getTrace());
        }
        echo "FINISED";
        Log::info("FInish monthly");
    }
}
