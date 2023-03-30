<?php

namespace App\Domain\Payment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use Illuminate\Support\Facades\DB;

class PaymentBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "purchase_id";
    }

    public function filterBy($filter)
    {
        if (isset($filter['created_at'])) {
            $this->orderBy("created_at");
        }
        if (isset($filter['not_waited'])) {
            $this->where(DB::raw("status % 10"), "!=", PurchaseStatus::WAIT_ANSWER);
        }
        return parent::filterBy($filter); // TODO: Change the autogenerated stub
    }
}