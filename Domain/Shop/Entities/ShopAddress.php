<?php

namespace App\Domain\Shop\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Delivery\Entities\DeliveryAddress;
use App\Domain\User\Entities\User;
use App\Domain\User\Traits\HasUserRelationship;

class   ShopAddress extends Entity
{
    use HasUserRelationship;

    protected $table = "shop_addresses";

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'user_id');
    }

    public function workTime(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(WorkTimes::class, "id");
    }

    public function delivery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DeliveryAddress::class, "delivery_address_id");
    }
}
