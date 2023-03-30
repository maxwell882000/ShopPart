<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Installment\Builders\MonthPaidBuilder;
use App\Domain\Installment\Interfaces\MonthPaidInterface;

class MonthPaid extends Entity implements MonthPaidInterface
{
    use HasPrice;

    protected $table = "month_paid";
    protected const BUILDER = MonthPaidBuilder::class;
    protected const INSTALLMENT = TakenCredit::class;
    public $timestamps = true;

    public function newEloquentBuilder($query): MonthPaidBuilder
    {
        $var = static::BUILDER;
        return new $var($query);
    }

    public function takenCredit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(static::INSTALLMENT, "taken_credit_id");
    }

    public function getPlasticToken()
    {
        return $this->takenCredit->plastic->card_token;
    }

    public function getMustPayShowAttribute(): string
    {
        return $this->formatPrice($this->must_pay);
    }

    public function getPaidShowAttribute(): string
    {
        return $this->formatPrice($this->paid);
    }

}
