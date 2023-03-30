<?php

namespace App\Domain\Installment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use Illuminate\Support\Facades\DB;

class PlasticTakenCreditBuilder extends BuilderEntity
{
    protected function parentTable(): string
    {
        return "plastic_card_taken_credit";
    }

    public function joinTakenCredit()
    {
        return $this->join(DB::raw($this->parentTable() . " as plastic" ), "plastic_card.id",
            "=",
            "plastic.plastic_id");
    }

    public function joinTakenCreditWhere($taken_credit_id)
    {
        return $this->joinTakenCredit()->where("plastic.taken_credit_id", '=', $taken_credit_id);
    }

    public function filterBy($filter)
    {
        if (isset($filter['taken_credit_id'])) {
            $this->joinTakenCreditWhere($filter['taken_credit_id']);
        }
        return parent::filterBy($filter);
    }

    protected function getSearch(): string
    {
        return "card_number";
    }
}
