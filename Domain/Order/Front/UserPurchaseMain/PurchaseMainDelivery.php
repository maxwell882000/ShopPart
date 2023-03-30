<?php

namespace App\Domain\Order\Front\UserPurchaseMain;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Delivery\Api\Interfaces\DpdExceptionInterface;
use App\Domain\Order\Front\Admin\CustomTables\PurchaseTableDelivery;

class PurchaseMainDelivery extends PurchaseMain
{
    public function getIdDeliveryIndexAttribute(): string
    {
        return TextAttribute::generation($this,
            $this->user_purchase_id * 100000 +
            $this->product->shop->shopAddress->id,
            true);
    }

    public function getStatusDeliveryAttribute(): string
    {

        $delivery = $this->getDelivery();
        if ($delivery) {
            // dd($delivery);
            $text = DpdExceptionInterface::DB_TO_FRONT[$delivery->status];
            return TextAttribute::generation($this, __($text), true);
        }
        return  "";
    }

    public function getTableClass(): string
    {
        return PurchaseTableDelivery::class;
    }
}
