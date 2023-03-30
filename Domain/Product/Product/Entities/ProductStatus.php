<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Core\Main\Entities\Entity;

class ProductStatus extends Entity
{
    protected $table = "products_product_stats";

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, "products_product_stats",
            "status",
            'product_id');
    }

}
