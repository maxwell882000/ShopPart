<?php

namespace App\Domain\Product\Api;

use App\Domain\Category\Api\CategoryProduct;
use App\Domain\CreditProduct\Api\MainCreditProductApi;
use App\Domain\Product\Color\Api\ProductMainColorApi;
use App\Domain\Product\HeaderText\Api\HeaderTextApi;
use App\Domain\Product\HeaderText\Pivot\HeaderProduct;
use App\Domain\Product\Images\Api\ImageApi;
use App\Domain\Product\ProductKey\Api\ProductKeyApi;
use App\Domain\Product\ProductKey\Pivot\ProductKeyProducts;
use App\Domain\Shop\Api\ShopProduct;


// do you need data from card?
class ProductView extends ProductCard
{
    public function productImage(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ImageApi::class, 'product_id');
    }

    public function colors()
    {
        return $this->hasMany(ProductMainColorApi::class, "product_id");
    }

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, "category_id");
    }

    public function shop()
    {
        return $this->belongsTo(ShopProduct::class, "shop_id");
    }

    public function mainCredit()
    {
        return $this->belongsToMany(MainCreditProductApi::class,
            "product_credits",
            "product_id",
            "main_credit_id"
        );
    }

    public function productKey(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductKeyApi::class,
            'product_keys_product',
            'product_id',
            'products_key_id')->using(ProductKeyProducts::class)->withPivot("id");
    }

    public function description(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductDescriptionApi::class, "product_id");
    }

    public function headerText()
    {
        return $this->belongsToMany(HeaderTextApi::class,
            "header_product",
            "product_id",
            'header_text_id'
        )->using(HeaderProduct::class)->withPivot(["id"]);
    }

    public function toArray()
    {
        $result = [
            "images" => $this->productImage,
            "category" => $this->category()->with(["parent"])->first()->toArray(),
            "colors" => $this->colors,
            "shop" => $this->shop->toArray(),
            "key_with_values" => $this->productKey->toArray(),
            "about_product" => $this->description->toArray(),
            "characteristics" => $this->headerText->toArray(),
            "installment" => $this->mainCredit()->with(["credits"])->first()
        ];
        $parent = parent::toArray();
        return array_merge($result, $parent);
    }
}
