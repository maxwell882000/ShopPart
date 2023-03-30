<?php

namespace App\Domain\Order\Api;

use App\Domain\Installment\Api\TakenCreditApi;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Payment\Api\PaymentApi;

class UserPurchasesApi extends UserPurchase
{
    public function takenCredit()
    {
        return $this->hasOne(TakenCreditApi::class, "purchase_id");
    }

    public function payment()
    {
        return $this->hasOne(PaymentApi::class, "purchase_id");
    }

    public function purchases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PurchaseApi::class, "user_purchase_id");
    }

    private function getStatus()
    {
        if ($this->isInstallment()) {
            return $this->getPayment() - 199;// we map like this because it is important
        }
        return $this->status % 10 + 1;
    }

    public function toArray()
    {

        $array = [
            'id' => $this->id,
            'status' => $this->getStatus(),
            'isDelivery' => $this->isDelivery(),
            'purchase' => $this->purchases,
            'originalPrice' => $this->purchases()->with("product")->get()->sum("original_price"),
            'productPrice' => $this->sumPurchases(),
            'allQuantity' => $this->getNumberPurchaseAttribute(),
            'sumDelivery' => $this->sumDelivery(),
        ];
        $array['payble'] = $this->payble();
        if ($this->isDelivery()) {
            $array['address'] = $this->getDeliveryAddressAttribute()->getFullAddressAttribute();
            $array['address_comment'] = $this->getDeliveryAddressAttribute()->instructions;
        }

        return $array;
    }
}
