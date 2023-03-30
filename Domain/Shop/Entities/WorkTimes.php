<?php

namespace App\Domain\Shop\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Shop\Builders\WorkTimeBuilder;

class   WorkTimes extends Entity
{
    protected $table = 'work_times';
    protected $guarded = ['params', 'id'];

    public function newEloquentBuilder($query)
    {
        return WorkTimeBuilder::new($query);
    }

    public function shopAddress(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ShopAddress::class, "shop_address_id");
    }

    public static function getRules(): array
    {
        return [
            "day" => "required|digits_between:1,7",
            "workTimeFrom" => "required|integer|digits_between:1,24",
            "workTimeTo" => "required|integer|digits_between:1,24"
        ];
    }
}
