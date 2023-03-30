<?php

namespace App\Domain\Installment\Api;

use App\Domain\Installment\Entities\MonthPaid;

class MonthPaidApi extends MonthPaid
{
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "must_pay" => $this->must_pay,
            "paid" => $this->paid,
            'month' => $this->month,
        ];
    }
}
