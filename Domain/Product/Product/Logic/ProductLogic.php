<?php

namespace App\Domain\Product\Product\Logic;

use App\Domain\Currency\Traits\ConvertToSum;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Interfaces\ProductInterface;

class ProductLogic implements ProductInterface
{
    use ConvertToSum;

    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    private function checkOrder()
    {
        $user = auth("sanctum")->user();
        if ($user && $basket = $user->basket()->where("product_id", $this->product->id)->first()) {
            return intval($basket->price);
        }
    }

    public function getPrice()
    {
        return $this->checkOrder() ?? $this->considerDiscounts();
    }

    private function considerCurrency()
    {
        $real_price = $this->product->price;
        if ($this->product->currency == self::CURRENCY_USD_DB)
            $real_price = $this->convertToSum($this->product->price);
        return $real_price;
    }

    public function getPriceCurrency()
    {
        return $this->considerCurrency();
    }

    public function discountPercent()
    {
        return $this->product->percentage
            + $this->product->discounts()->sum("percent");
    }

    private function getDiscountPrice($real_price)
    {
        return $this->discountPercent() / 100 * $real_price;
    }

    private function considerDiscounts()
    {
        $real_price = $this->considerCurrency();
        if ($this->product->discounts()->exists()) {
            $calculate_percent_price = $this->getDiscountPrice($real_price);
            return $real_price - $calculate_percent_price;
        }
        if ($this->product->percentage) {
            return $real_price - $this->product->percentage / 100 * $real_price;
        }
        return $real_price;
    }
}
