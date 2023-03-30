<?php

namespace App\Domain\Installment\Jobs;

use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Api\CardService\Model\WithdrawMoney;
use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Installment\Interfaces\MonthPayableInterface;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Installment\Services\PennyService;
use App\Domain\Installment\Services\TimeScheduleService;
use App\Domain\User\Entities\PlasticCard;
use Illuminate\Support\Facades\Log;

// do we need to add token to the construct ?

class FailedToWithdraw extends AbstractJob implements PurchaseStatus
{
    const TIMES_TO_TAKE = 5;
    private WithdrawMoney $withdrawMoney;
    private MonthPayableInterface $payable;
    private PennyService $pennyService;
    private int $counter;

    public function __construct(MonthPayableInterface $payable, int $counter = 0)
    {
        $this->payable = $payable;
        $this->pennyService = new PennyService();
        $this->counter = $counter;
    }

    protected function getService(): string
    {
        return TimeScheduleService::class;
    }

    public function handle()
    {
        echo "start dispatching";
        try {
            $this->withdrawMoney = new WithdrawMoney($this->payable);
            $service = $this->getService();
            $numberCard = PlasticCard::byToken($this->withdrawMoney->getToken())->first()->pan;
            $taken_id = $this->payable->getTakenCreditId();
            $isWithdrawn = false;
            Log::info("started failed withdraw");
            echo "loop starts";
            if ($this->counter <= self::TIMES_TO_TAKE) {
                if ($this->payable->amount() > 0) {
                    // there could be case that user has paid while
                    // we tried to withdraw from auto subscription
                    try {
                        $this->withdrawMoney->withdraw();
                        $service::success($numberCard, $taken_id);
                        $isWithdrawn = true;
                    } catch (CardServiceError $exception) {
                        $service::failedLoop($numberCard, $exception->getMessage(), $taken_id);
                        static::dispatch($this->payable, $this->counter++)->delay(now()->addHours(2));
                        return;
                    }
                } else {
                    $isWithdrawn = true;
                }
            }
            if (!$isWithdrawn) {
                // if we fail to withdraw money, we will create penny
                // logical
                $this->pennyService->create(['month_paid_id' => $this->payable->id]);
                $this->payable->status = self::NOT_PAID;
                $this->payable->save();
            }
        } catch (\Throwable $exception) {
            Log::info("FailedToWithdraw \n");
            Log::info($exception);
        }

    }
}
