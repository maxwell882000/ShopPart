<?php

namespace App\Domain\Installment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class TransactionBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "transaction_id";
    }

    public function filterBy($filter)
    {
//        dd($filter);

        if (isset($filter['month_id'])) {
            $this->where("month_id", "=", $filter['month_id']);
        }
        return parent::filterBy($filter);
    }
}
