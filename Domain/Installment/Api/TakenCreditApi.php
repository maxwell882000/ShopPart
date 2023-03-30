<?php

namespace App\Domain\Installment\Api;

use App\Domain\Installment\Entities\TakenCredit;

class TakenCreditApi extends TakenCredit
{
    public function monthPaid()
    {
        return $this->hasMany(MonthPaidApi::class, 'taken_credit_id');
    }

    public function toArray()
    {
        $array = [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'price' => $this->price,
            'accepted_time' => $this->date_taken,
            'month_paid' => $this->eachMonthPayment(),
            'rest_month' => $this->numberRestToPay(),
            'next_paid_month' => $this->nextPay()->id,
            'number_month' => $this->monthPaid()->count(),
            'status' => $this->status,
            'months' => $this->monthPaid()->orderBy('month')->get(),
            'initial_pay' => intval($this->initial_price),
            'all_to_pay' => intval($this->allToPay()),
            'already_paid' => intval($this->alreadyPaid()),
        ];
        if ($this->isDeclined()) {
            $array['reason'] = $this->reason->current_reason;
        }
        return $array;
    }
}
