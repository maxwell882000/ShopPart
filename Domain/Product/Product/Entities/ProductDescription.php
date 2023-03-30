<?php

namespace App\Domain\Product\Product\Entities;

use App\Domain\Core\Language\Traits\Translatable;
use App\Domain\Core\Main\Entities\Entity;

class ProductDescription extends Entity
{
    use Translatable;

    protected $table = "product_descriptions";

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function getHeaderAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("header");
    }

    public function setHeaderAttribute($value)
    {
        $this->setTranslate("header", $value);
    }

    public static function getCreateRules(): array
    {
        return [
            'header' => 'required',
            'body' => 'required'
        ];
    }


    public function getHeaderCurrentAttribute()
    {
        return $this->getTranslatable("header");
    }

    public function getBodyAttribute(): ?\Illuminate\Support\Collection
    {
        return $this->getTranslations("body");
    }

    public function getBodyCurrentAttribute()
    {
        return $this->getTranslatable("body");
    }

    public function setBodyAttribute($value)
    {
        $this->setTranslate("body", $value);
    }


}
