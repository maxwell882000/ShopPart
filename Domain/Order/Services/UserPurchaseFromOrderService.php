<?php

namespace App\Domain\Order\Services;

use App\Domain\Order\Entities\Order;

class UserPurchaseFromOrderService extends UserPurchaseService
{
    protected function toPurchases(array &$object_data): array
    {
        if (isset($object_data['orders'])) {
            $purchases = [];
            $order_query = Order::whereIn("id", $object_data['orders']);
            $orders = $order_query->get();
            foreach ($orders as $order) {
                $purchases[] = [
                    'quantity' => $order->quantity,
                    'price' => $order->price * $order->quantity,
                    'product_id' => $order->product_id,
                    'order_delivery_id' => $this->entity->isDelivery() ? $order->order_delivery_id : null, // ensure that
                    // at first user chose delivery than change mind, delivery cost won`t be added
                    // for his check
                    "order" => json_encode($order->order, JSON_UNESCAPED_UNICODE)
                ];
            }
            $order_query->delete();
            return $purchases;
        }
        return [];
    }
}
