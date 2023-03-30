<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\PennyForMonthPaidBuilder;
use App\Domain\Installment\Payable\MonthPaidPayable;

class PennyForMonthPaid extends Entity
{
    protected $table = "penny_for_transaction";
    public $timestamps = true;
    const MONTH_PAID = MonthPaidPayable::class;
    const BUILDER = PennyForMonthPaidBuilder::class;

    public function newEloquentBuilder($query)
    {
        $class = static::BUILDER;
        return new $class($query);
    }

    public function month_paid()
    {
        return $this->belongsTo(static::MONTH_PAID, "month_paid_id");
    }
}
