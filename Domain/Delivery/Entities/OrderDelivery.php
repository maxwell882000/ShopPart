<?php

namespace App\Domain\Delivery\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Order\Entities\Order;

class OrderDelivery extends Entity
{

    // every purchase which is located inside the shop has the same
    // order delivery number , so I will be able to calculate the price of the delivery
    protected $table = "order_deliveries";
    public $timestamps = true;

    public function order(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class, "order_delivery_id");
    }

}
