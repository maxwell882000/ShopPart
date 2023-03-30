<?php

use App\Domain\Installment\CustomInstallment\Payable\CustomMonthPaidPayable;

if (!function_exists('decline_query')) {
    function decline_query(int $days = 0): int
    {

        return \Illuminate\Support\Facades\DB::table("taken_credits")
            ->crossJoin("custom_installment")
            ->where(function ($query) {
                return $query->where("taken_credits.status", "=",
                    \App\Domain\Installment\Interfaces\PurchaseStatus::DECLINED)
                    ->orWhere("custom_installment.status", "=",
                        \App\Domain\Installment\Interfaces\PurchaseStatus::DECLINED);
            })
            ->where(function ($query) use ($days) {
                return $query->whereDate('taken_credits.created_at', "=", now()->subDays($days))
                    ->OrwhereDate('custom_installment.created_at', "=", now()->subDays($days));
            })->count();
    }
}

if (!function_exists('month_job')) {
    function month_job(array $values = [])
    {
        // $s = FailedToWithdraw::class;
        $month = CustomMonthPaidPayable::first();
        \App\Domain\Installment\CustomInstallment\Jobs\CustomMonthPaidJobs::dispatch($month);
        // $service->list_cards(1, 10);
        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}
if (!function_exists('get_payment_info')) {
    function get_payment_info(array $values = [])
    {
        // $s = FailedToWithdraw::class;
        $m = new \App\Domain\Core\Api\CardService\Merchant\Model\Merchant();
        dd($m->get(53148));
        // $service->list_cards(1, 10);
        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}

if (!function_exists('status_order')) {
    function status_order(array $values = [])
    {
        // $s = FailedToWithdraw::class;
        $delivery = \App\Domain\Order\Entities\UserPurchase::find(101407)->delivery()->first();
        $service = new \App\Domain\Delivery\Api\Models\DpdOrder();
        dd($service->getOrderStatus($delivery));
        // $service->list_cards(1, 10);
        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}

