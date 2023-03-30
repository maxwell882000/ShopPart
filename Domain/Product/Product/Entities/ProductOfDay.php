<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\CheckedAttribute;
use App\Domain\Product\Api\ProductCard;
use App\Domain\Product\Product\Jobs\ProductOfDayJob;

class ProductOfDay extends Entity
{
    use CheckedAttribute;

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected static function booting()
    {
        self::creating(function ($product) {
            $product->start_time = now();
            $product->end_time = now()->addDay();
            ProductOfDayJob::dispatch($product->product)->delay(now()->addDay());
        });
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCard::class, 'product_id');
    }

    public function toArray()
    {
        return $this->product->toArray();
    }
}
