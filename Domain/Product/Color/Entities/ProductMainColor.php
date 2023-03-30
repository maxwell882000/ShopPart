<?php

namespace App\Domain\Product\Color\Entities;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Media\Traits\MediaManyTrait;
use App\Domain\Core\Media\Traits\MediaTrait;

class ProductMainColor extends Entity
{
    use MediaTrait, MediaManyTrait;


    protected $table = "color_products";

    public function manyColor(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductManyColor::class, "color_product_id");
    }

    public static function getCreateRules(): array
    {
        return [
            'color_id' => 'required'
        ];
    }

    public function color()
    {
        return $this->belongsTo(Color::class, "color_id");
    }

    public function getImageAttribute($value): \App\Domain\Core\Media\Models\Media
    {
        return $this->getMedia("image", $value, $this->id);
    }

    public function setImageAttribute($value)
    {
        $this->setMedia("image", $value, $this->id);
    }

    public function getImagesAttribute()
    {
        return $this->getManyMedia("manyColor", "image");
    }

    public function setImagesAttribute($value)
    {
        $this->setSaveManyMedia("manyColor", $value, "image");
    }

    public function getMediaPathStorages()
    {
        return "product/main/color";
    }

    public function mediaKeys(): array
    {
        return [
            'images'
        ];
    }
}
