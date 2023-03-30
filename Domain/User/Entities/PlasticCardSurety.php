<?php

namespace App\Domain\User\Entities;

use App\Domain\User\Builders\PlasticCardBuilder;
use App\Domain\User\Builders\PlasticCardSuretyBuilder;

class PlasticCardSurety extends PlasticCard
{
    public function newEloquentBuilder($query): PlasticCardBuilder
    {
        return new PlasticCardSuretyBuilder($query);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Surety::class,
            "plastic_surety_cards",
            "plastic_id",
            "surety_id");
    }
}
