<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\User\Builders\PlasticCardBuilder;
use App\Domain\User\Traits\PlasticCardTrait;

// it does not have user because it can belong to surety
class PlasticCard extends Entity
{
    use PlasticCardTrait;

    protected $table = 'plastic_card';
    protected $guarded = [
        'date_number',
    ];

    public function newEloquentBuilder($query): PlasticCardBuilder
    {
        return new PlasticCardBuilder($query);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, "plastic_user_cards",
            "plastic_id",
            "user_id");
    }
}
