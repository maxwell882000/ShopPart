<?php

namespace App\Domain\Product\ProductKey\Pivot;

use App\Domain\Product\ProductKey\Entities\ProductValue;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductKeyProducts extends Pivot
{
    protected $table = "product_keys_product";
    public $incrementing = true;
    public $timestamps = false;

    public function value()
    {
        return $this->hasMany(
            ProductValue::class,
            "product_key_id");
    }

    public function toArray()
    {
        return $this->value->toArray();
    }
}
