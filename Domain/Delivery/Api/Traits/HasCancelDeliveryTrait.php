<?php

namespace App\Domain\Delivery\Api\Traits;

use App\Domain\Delivery\Api\Services\OrderService;

trait HasCancelDeliveryTrait
{

    public function cancelDelivery()
    {
        $purchase = $this->entity->purchase;
        if ($purchase->isDelivery()) {
            $delivery = new OrderService();
            $delivery->cancelOrderByPurchase($purchase);
        }
    }

}
