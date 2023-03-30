<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\User\Builders\SuretyBuilder;
use App\Domain\User\Interfaces\SuretyRelationInterface;
use App\Domain\User\Traits\HasUserRelationship;

class Surety extends Entity implements SuretyRelationInterface
{
    use HasUserRelationship;

    public function newEloquentBuilder($query)
    {
        return new SuretyBuilder($query);
    }

    protected $table = 'surety_data';

    public function plastic(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(PlasticCard::class,
            'plastic_surety_cards',
            'plastic_id',
            "surety_id");
    }

    public function getPlasticTokens(): \Illuminate\Support\Collection
    {
        return $this->plastic()->pluck('card_token');
    }

    public function crucialData(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CrucialData::class, "crucial_data_id");
    }


    public static function getRules(): array
    {
        return [
            "" => "",
        ];
    }
}
