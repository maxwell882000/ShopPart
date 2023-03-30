<?php

namespace App\Domain\Installment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use Illuminate\Support\Facades\DB;

class MonthPaidBuilder extends BuilderEntity
{
    // include parent table for future use and unpaidForMonth
    protected function parentTable(): string
    {
        return "taken_credits";
    }

    // include own table name
    protected function ownTable()
    {

        return "month_paid";
    }

    protected function getSearch(): string
    {
        return "paid";
    }

    protected function getParent(): string
    {
        return "taken_credit_id";
    }


    // will be rewritten
    public function unpaidForMonth()
    {
        return $this
            ->from($this->ownTable(), "first")
            ->join(DB::raw($this->parentTable() . " as taken"), "taken.id", "=", "first.taken_credit_id")
            ->where(DB::raw("ABS(taken.status)"), "=", PurchaseStatus::ACCEPTED)
            ->whereColumn("first.paid", "<", "first.must_pay") // check already paid or not
            ->whereDate("first.month", "<=", now())
            ->select('first.*')
            ->distinct();
    }
}
