<?php

namespace App\Domain\Order\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Delivery\Entities\Delivery;
use App\Domain\Order\Builders\PurchaseBuilder;
use App\Domain\Product\Product\Entities\Product;

class Purchase extends Entity
{
    protected $table = "purchases";
    public $timestamps = true;

    public function newEloquentBuilder($query)
    {
        return new PurchaseBuilder($query);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function userPurchase()
    {
        return $this->belongsTo(UserPurchase::class, 'user_purchase_id');
    }

    public function getOriginalPriceAttribute()
    {
        return $this->product->getLogic()->getPriceCurrency() * $this->quantity;
    }

    public function getDelivery()
    {
        return Delivery::where("user_purchase_id", "=", $this->user_purchase_id)
            ->where("shop_address_id", "=", $this->product->shop->shopAddress->id)->first();
    }
}
