<?php

namespace App\Domain\Product\ProductKey\Entities;

class ProductKeyReadOnly extends ProductKey
{
    protected $fillable = [
        "id",
        "text",
        "text_ru",
        "text_uz",
        "text_en"
    ];
}
