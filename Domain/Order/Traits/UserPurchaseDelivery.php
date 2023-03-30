<?php

namespace App\Domain\Order\Traits;

use App\Domain\Core\Main\Traits\HasPrice;
use App\Domain\Delivery\Entities\Delivery;
use App\Domain\Delivery\Interfaces\DeliveryStatus;
use Illuminate\Support\Facades\DB;

trait UserPurchaseDelivery
{
    use HasPrice;

    public function delivery(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Delivery::class, "user_purchase_id");
    }

    public function deliveryCount()
    {
        return $this->delivery()->count();
    }

    public function deliveredCount()
    {
        return $this->delivery()->where(DB::raw("status % 10"), "!=", DeliveryStatus::CREATED)->count();
    }

    public function sumDelivery()
    {
        return $this->purchases()->join("order_deliveries",
            "order_deliveries.id", "=", "purchases.order_delivery_id")
            ->groupBy("order_deliveries.id")
            ->sum("order_deliveries.price");
    }

    abstract public function purchases();

    public function sumDeliveryShow()
    {
        return $this->formatPrice($this->sumDelivery());
    }
}
