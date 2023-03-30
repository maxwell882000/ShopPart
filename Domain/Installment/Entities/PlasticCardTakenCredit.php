<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\PlasticTakenCreditBuilder;
use App\Domain\User\Traits\PlasticCardTrait;

class PlasticCardTakenCredit extends Entity
{
    use PlasticCardTrait;

    protected const BUILDER = PlasticTakenCreditBuilder::class;
    protected const INSTALLMENT = TakenCredit::class;
    protected const PIVOT_TABLE = 'plastic_card_taken_credit'; // for taken credit
    protected $table = 'plastic_card';
    protected $guarded = [
        'date_number',
    ];

    public function newEloquentBuilder($query)
    {
        $var = static::BUILDER;
        return new $var($query);
    }

    public function takenCredit()
    {
        return $this->belongsToMany(static::INSTALLMENT,
            static::PIVOT_TABLE,
            "plastic_id",
            "taken_credit_id");

    }
}
