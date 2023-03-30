<?php

namespace App\Domain\Payment\Api;

use App\Domain\Payment\Entities\Payment;

class PaymentApi extends Payment
{
    public function toArray()
    {
        $array = [
            'id' => $this->id,
            "price" => $this->price,
            "status" => $this->status,
            "accepted_time" => $this->accepted_at,
        ];
        if ($this->isDeclined() && $this->reason) {
            $array['reason'] = $this->reason->current_reason;
        }
        return $array;
    }
}
