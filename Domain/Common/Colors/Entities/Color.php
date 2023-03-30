<?php

namespace App\Domain\Common\Colors\Entities;

use App\Domain\Common\Colors\Builders\ColorsBuilder;
use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Product\Entities\Product;
use Illuminate\Support\Collection;

class Color extends Entity
{
    use Translatable;

    protected $table = "colors";

    public function newEloquentBuilder($query)
    {
        return new ColorsBuilder($query);
    }

    public function getColorAttribute(): Collection
    {
        return $this->getTranslations("color");
    }

    public function getColorCurrentAttribute(): ?string
    {
        return $this->getTranslatable("color");
    }

    public function setColorAttribute($value)
    {
        $this->setTranslate("color", $value);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,
            "color_products",
            "color_id",
            "product_id");
    }
}
