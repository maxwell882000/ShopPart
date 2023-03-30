<?php

namespace App\Domain\Product\ProductKey\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\ProductKey\Builders\ProductValueBuilder;
use App\Domain\Product\ProductKey\Traits\TextTranslation;

class ProductValue extends Entity
{
    use TextTranslation;

    protected $guarded = null;
    protected $table = 'product_values';
    protected $fillable = [
        "text",
        "text_ru",
        "text_uz",
        'price',
//        "text_en",
        'product_key_id'
    ];

    public function newEloquentBuilder($query): ProductValueBuilder
    {
        return new ProductValueBuilder($query);
    }
    public static function getRules(): array
    {
        return [
            "text_ru" => "required",
            "text_uz" => "required",
            'price' => ""
//            "text_en" => "required",
        ];
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'text' => $this->getTextCurrentAttribute(),
            'price' => $this->price
        ];
    }
}

