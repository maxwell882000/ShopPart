<?php

namespace App\Domain\Product\Api;

use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\CreditProduct\Entity\Credit;
use App\Domain\Order\Entities\Order;
use App\Domain\Product\Product\Builders\ProductBuilder;
use App\Domain\Product\Product\Builders\ProductCardBuilder;
use App\Domain\Product\Product\Entities\Product;
use Illuminate\Support\Facades\DB;

class ProductCard extends Product
{
    public function newEloquentBuilder($query)
    {
        return ProductCardBuilder::new($query);
    }

    private function calculateForCreditPrice(Credit $credit, $price)
    {
        $percent_price = $credit->percent * $price / 100;
        $real_price = $percent_price + $price;
        return $real_price / $credit->month;
    }



    private function credit()
    {
        if ($this->mainCredit()->exists()) {
            $main = $this->mainCredit()->first();
            $credit = $main->lastCredit();
            return [
                "month" => $credit->month,
                "price" => $this->formatPrice($this->calculateForCreditPrice($credit, $this->real_price)),
                "name" => $this->mainCredit()->first()->name_current
            ];
        }
        return [];
    }

    public function getOrder(Order $order)
    {
        $response = [
            'id' => $order->id
        ];
        if (isset($order->order['colors'])) {
            $response['colors'] = $order->order['colors'];
        }
        if (isset($order->order['additional'])) {
            $response['additional'] = $order->order['additional'];
        }
        return $response;
    }

    public function toArray()
    {
        $response = [
            "id" => $this->id,
            "image" => $this->productImageHeader->image->fullPath(),
            "title" => $this->title_current,
            "favourite" => false,
            "basket" => false,
            "price" => $this->formatPrice($this->productLogic->getPriceCurrency()),
            "discount" => $this->productLogic->discountPercent(), // percent of discount for the card
            "real_price" => $this->formatPrice($this->real_price),
            "mark" => number_format($this->mark()->avg("mark"), 1) ?? 0,
            "num_comment" => $this->comment()->count(),
        ];
        if ($user = auth('sanctum')->user()) {
            $response['favourite'] = $user->favourite()->where("favourites.product_id", $this->id)->exists();
            $basket = $user->basket()->where("orders.product_id", $this->id);
            $response['basket'] = $basket->exists();
            if ($response['basket']) {
                $order = $basket->first();
                $response['order'] = $this->getOrder($order);
            }
        }
        $response['credit'] = $this->credit();
        return $response;
    }
}
