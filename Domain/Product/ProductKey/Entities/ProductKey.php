<?php

namespace App\Domain\Product\ProductKey\Entities;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\ProductKey\Builders\ProductKeyBuilder;
use App\Domain\Product\ProductKey\Pivot\ProductKeyProducts;
use App\Domain\Product\ProductKey\Traits\TextTranslation;

class ProductKey extends Entity
{
    use TextTranslation;

    protected $guarded = null;
    protected $fillable = [
        "text",
        "text_ru",
        "text_uz",
        "text_en",
        "type"
    ];
    protected $table = 'product_keys';


    public function newEloquentBuilder($query)
    {
        return new ProductKeyBuilder($query);
    }

    //**
    // connect with product , so we then can get the values of for the product
    //*/
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, "product_keys_product",
            "product_key_id",
            "product_id")->using(ProductKeyProducts::class)
            ->withPivot("id");
    }

    /*
     * this for filtration , mainly connects header with key
     * **/
    public function filtration()
    {
        return $this->belongsToMany(Category::class, "filtration_key_category",
            "product_key_id",
            "category_id");
    }


}
