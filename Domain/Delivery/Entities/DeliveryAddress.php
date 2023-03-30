<?php

namespace App\Domain\Delivery\Entities;

use App\Domain\Core\Main\Entities\Entity;

class DeliveryAddress extends Entity
{
    protected $table = "delivery_address";
    public $timestamps = true;

    public function availableCities(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AvailableCities::class, "city_id");
    }

    public function getFullAddressAttribute()
    {
        return sprintf("%s, %s, %s",
//            $this->availableCities->countryNameCurrent,
            $this->availableCities->cityNameCurrent,
            $this->street,
            $this->house);
    }

    public function toArray()
    {

        return array_merge(parent::toArray(), $this->availableCities->toArray());
    }

    public static function getCreateRules(): array
    {
        return [
//            "index" => "digits:6",
        ];
    }
}
