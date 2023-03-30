<?php

namespace App\Domain\Category\Api;

use App\Domain\Category\Entities\Category;
use App\Domain\Product\Api\ProductCard;

class CategoryItself extends Category
{
    public function products()
    {
        return $this->hasMany(ProductCard::class, 'category_id');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->getNameCurrentAttribute(),
            "slug" => $this->slug,
            "is_last" => $this->height == 0
        ];
    }
}
