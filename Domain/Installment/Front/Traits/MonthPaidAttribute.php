<?php

namespace App\Domain\Installment\Front\Traits;

use App\Domain\Core\Main\Traits\HasPrice;
use Illuminate\Support\Facades\DB;

trait   MonthPaidAttribute
{
    use HasPrice;

    abstract public function monthPaid();

    public function restToPay()
    {
        return $this->allToPay() - $this->alreadyPaid();
    }

    public function restToPayShow()
    {
        return $this->formatPrice($this->restToPay());
    }

    public function allToPay()
    {
        return $this->monthPaid()->sum('must_pay');
    }

    public function allToPayShow()
    {
        return $this->formatPrice($this->allToPay());
    }

    public function alreadyPaidShow()
    {
        return $this->formatPrice($this->alreadyPaid());
    }

    public function alreadyPaid()
    {
        return $this->monthPaid()->sum('paid');
    }


    public function eachMonthPayment()
    {
        return $this->monthPaid()->first()->must_pay;
    }

    public function eachMonthPaymentShow()
    {
        return $this->formatPrice($this->eachMonthPayment());
    }

    public function numberRestToPay()
    {
        return $this->monthPaid()->whereRaw("must_pay != paid")
            ->count();
    }

    public function numberMonthAlreadyPaid()
    {
        return $this->monthPaid()
            ->whereRaw("must_pay = paid")
            ->count();
    }

    public function getMonthlyPaidAttribute()
    {
        return $this->eachMonthPayment();
    }

    public function nextPay()
    {

        return $this->monthPaid()
                ->whereColumn("must_pay", ">", "paid")
                ->orderBy("month")->first() ?? $this->defaultNextMonth();
    }

    private function defaultNextMonth()
    {
        $class = new \stdClass();
        $class->id = -1;
        $class->month = "";
        return $class;
    }

    public function nextPayDate()
    {
        return $this->nextPay()->month;
    }

    public function getSaldoAttribute() // made perfectly
    {
        return $this->monthPaid()
            ->where("month", "<=", now())
            ->sum(DB::raw("paid - must_pay"));
    }

    public function getSaldoShowAttribute()
    {
        return $this->formatPrice($this->saldo);
    }
}
