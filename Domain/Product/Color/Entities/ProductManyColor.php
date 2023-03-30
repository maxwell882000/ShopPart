<?php

namespace App\Domain\Product\Color\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaTrait;

class ProductManyColor extends Entity
{
    use MediaTrait;
    protected $table = "color_products_many";
    public function getMediaPathStorages()
    {
        return "product/many/color";
    }

    public function main(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductMainColor::class, "color_product_id");
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $value, $this->id);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function mediaKeys(): array
    {
        return [
            'image'
        ];
    }
}
