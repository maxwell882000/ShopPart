<?php

namespace App\Domain\Installment\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class PennyForMonthPaidBuilder extends BuilderEntity
{
    protected function installmentTable()
    {
        return "taken_credits";
    }

    protected function monthTable()
    {
        return "month_paid";
    }

    protected function ownTable()
    {
        return "penny_for_transaction";
    }

    public function joinMonth()
    {
        return $this->join($this->monthTable(), $this->monthTable() . ".id",
            "=", $this->ownTable() . ".month_paid_id");
    }

    public function joinInstallment()
    {
        return $this->joinMonth()->join($this->installmentTable(), $this->installmentTable() . '.id', "=",
            $this->monthTable() . ".taken_credit_id");
    }

    // we will check if the client paid all required sum
    public function unpaid()
    {
//        return $this->joinInstallment()->where($this->installmentTable() . ".penny",
//            ">", $this->ownTable() . ".paid");
        return $this->where("paid", "=", 0);
    }
}
