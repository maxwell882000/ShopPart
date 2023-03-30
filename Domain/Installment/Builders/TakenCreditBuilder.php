<?php

namespace App\Domain\Installment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use Illuminate\Support\Facades\DB;

class TakenCreditBuilder extends BuilderEntity
{
    use HasPrice;

    protected function ownTable()
    {
        return "taken_credits";
    }

    protected function getSearch(): string
    {
        return "purchase_id";
    }

    protected function monthPaidTable()
    {
        return "month_paid";
    }

    public function filterBy($filter)
    {
        parent::filterBy($filter);
        if (isset($filter['filter'])) {
            $this->orderByRaw("status % 10")->orderBy("created_at");
        }
        if (isset($filter['not_waited']) && !isset($filter['waited'])) {
            $this->where(DB::raw("status % 10"), "!=", PurchaseStatus::WAIT_ANSWER);
        }
        if (isset($filter['accepted'])) {
            $this->accepted();
        }
        if (isset($filter['waited'])) {
            $this->waited();
        }
        if (isset($filter['declined'])) {
            $this->declined();
        }
        if (isset($filter['finished'])) {
            $this->finished();
        }
        if (isset($filter['today'])) {
            $this->today();
        }
        if (isset($filter['unpaid'])) {
            $this->unpaidCredits()->select("taken_credits.*");
        }
        return $this;
    }

    protected function newInMonth()
    {
        return $this->where("created_at", ">", now()->subMonth());
    }


    public function unpaidCreditCount()
    {
        return $this->unpaidCredits()->count('taken_credits.id');
    }

    public function amountOfUnpaidCredit()
    {
        return $this->unpaidCredits()->amountToPay();
    }

    public function amountToPay()
    {
        return $this->sum(DB::raw($this->monthPaidTable() . ".must_pay" . "-" . $this->monthPaidTable() . ".paid"));
    }

    public function today()
    {
        return $this->where("taken_credits.created_at", "=", now()->subDay());
    }

    public function accepted()
    {
        return $this->status(PurchaseStatus::ACCEPTED);
    }

    private function status($status)
    {
        return $this->where(DB::raw("ABS(taken_credits.status)"), "=", $status);

    }

    public function finished()
    {
        return $this->status(PurchaseStatus::FINISHED);
    }

    public function declined()
    {
        return $this->status(PurchaseStatus::DECLINED);
    }

    public function waited()
    {
        return $this->status(PurchaseStatus::WAIT_ANSWER);
    }

    public function acceptedAmountToPay()
    {
        return $this->accepted()->joinMonthPaid()->amountToPay();
    }

    public function joinMonthPaid()
    {
        return $this->join($this->monthPaidTable(), $this->monthPaidTable() . ".taken_credit_id",
            "=", "taken_credits.id");
    }

    public function allUnpaid()
    {
        return $this->from($this->ownTable(), "taken_credits")
            ->joinMonthPaid()
            ->accepted()
            ->whereColumn($this->monthPaidTable() . ".paid",
                "<", $this->monthPaidTable() . ".must_pay")
            ->distinct();
    }

    private function tillCurrentMonth($days = 0)
    {
        return $this->whereDateMonthPaid("<=", now()->subDays($days));
    }

    private function whereDateMonthPaid($operator, $month)
    {
        return $this->whereDate($this->monthPaidTable() . ".month",
            $operator, $month);
    }

    private function soonPayment($days = 1)
    {
        return $this->whereDateMonthPaid("<=", now()->addDays($days))
            ->whereDateMonthPaid(">=", now());
    }

    public function todayPayment()
    {
        return $this->whereDateMonthPaid("=", now());
    }

    public function unpaidCredits()
    {
        return $this->allUnpaidTillCurrentMonth(0);
        // check  day of payment gone
    }

    public function allUnpaidTillCurrentMonth($days)
    {
        return $this->allUnpaid()->tillCurrentMonth($days);
    }

    public function amountOfUnpaidCreditShow()
    {
        return $this->formatPrice($this->amountOfUnpaidCredit());
    }

    public function acceptedAmountToPayShow()
    {
        return $this->formatPrice($this->acceptedAmountToPay());
    }
}
