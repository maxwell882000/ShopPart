<?php

namespace App\Domain\Product\Color\Api;

use App\Domain\Product\Color\Entities\ProductMainColor;
use App\Domain\Product\Color\Entities\ProductManyColor;

class ProductMainColorApi extends ProductMainColor
{
    public function manyColor(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductManyColorApi::class,
            "color_product_id");
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            "image" => $this->image->fullPath(),
            "color_name" => $this->color->color_current,
            "images" => $this->manyColor->toArray()
        ];
    }
}
