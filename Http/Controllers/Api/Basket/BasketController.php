<?php

namespace App\Http\Controllers\Api\Basket;

use App\Domain\Product\Api\ProductCard;
use App\Http\Controllers\Api\Base\ApiController;

// write this down
class BasketController extends ApiController
{
    public function view()
    {
        $response = collect([]);
        $orders = auth()->user()->basket;
        foreach ($orders as $order) {
            $order = collect($order);
            $shop = $order->pull("shop"); // get shop of the order and pull from the order
            $key_specific = -1; // init variable
            // iterate over the result array to find whether it already contains that shop
            try {
                foreach ($response as $key => $value) {
                    if ($value['shop']['slug'] == $shop['slug']) {
                        $key_specific = $key; // if it contains store the index
                        break;
                    }

                }
            } catch (\Exception $exception) {
                continue;
            }

            // if index was found ,add additional orders to that shop
            if ($key_specific != -1) {
                $previous_specific = $response[$key_specific];
                $previous = $response[$key_specific]['orders'] ?? [];
                $previous_specific['orders'] = array_merge($previous, [$order]);
                $response[$key_specific] = $previous_specific;
            } else { // initialize the new shop if the index was not found
                $response->push([
                    "shop" => $shop,
                    "orders" => [
                        $order
                    ]
                ]);
            }
        }
        return $this->result([
            'basket' => $response->toArray(),
            'count' => $orders->count()
        ]);
    }

    public function maybeInteresting()
    {
        $category_id = auth()->user()->basket()->join('products',
            'products.id', '=', 'product_id')->distinct()->pluck('products.category_id')->toArray();
        $product_id = auth()->user()->basket()->pluck('product_id');
        return $this->result([
            'products' => ProductCard::notIdIn($product_id)->byCategoryIn($category_id)->take(self::BIG_PAGINATE)->get()
        ]);
    }
}
