<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Installment\Builders\TransactionBuilder;

// stores current transactions
// so one monthPaid can be paid twice or more
// created in monthPaidPayable
class Transaction extends Entity
{
    use HasPrice;
    protected $table = "transactions";
    public $timestamps = true;
    const MONTH_PAID = MonthPaid::class;
    const BUILDER = TransactionBuilder::class;

    public function monthPaid()
    {
        return $this->belongsTo(static::MONTH_PAID, "month_id");
    }

    public function newEloquentBuilder($query)
    {
        $var = static::BUILDER;
        return new $var($query);
    }
    public function getAmountShowAttribute() {
        return $this->formatPrice($this->amount);
    }
}
