<?php

namespace App\Domain\Order\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


class UserPurchaseBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "id";
    }

    public function today()
    {
        return $this->whereDate('user_purchases.created_at', '=', now())->whereNotNull("created_at");
    }

    public function todayCount()
    {
        return $this->today()->count();
    }

    public function filterBy($filter)
    {
        parent::filterBy($filter);
        if (isset($filter['by_created_at'])) {
            $this->orderByDesc("created_at");
        }
        if (isset($filter['today'])) {
            $this->today();
        }
        if (isset($filter['user_id'])) {
            $this->where("user_id", $filter['user_id']);
        }
        if (isset($filter['waited'])) {
            $this->waited();
        }
        if (isset($filter['status'])) {
            $status = $filter['status'];
            $this->checkStatus($status);
            unset($filter['status']);
        }
        return $this;
    }

    public function checkStatus($status)
    {
        return $this->where(function ($auery) use ($status) {
            $auery->whereExists(function (Builder $query) use ($status) {
                $query->select(DB::raw(1))
                    ->from("taken_credits")
                    ->whereColumn("taken_credits.purchase_id", "=", "user_purchases.id")
                    ->where(DB::raw("taken_credits.status % 10"), "=", $status);
            })->orWhereExists(function ($query) use ($status) {
                $query->select(DB::raw(1))
                    ->from("payments")
                    ->whereColumn("payments.purchase_id", "=", "user_purchases.id")
                    ->where(DB::raw("payments.status % 10"), "=", $status);
            });
        });
    }

    public function waited()
    {
        return $this->checkStatus(PurchaseStatus::WAIT_ANSWER);
    }
}
