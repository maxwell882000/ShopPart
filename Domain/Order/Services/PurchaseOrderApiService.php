<?php

namespace App\Domain\Order\Services;
// there will be multiple orders which has to be translated to the purchases
// depending on way of payment:
//----- Installment
//++++++ TakenCredit must be created (TakenCreditService)
//----- Payment
//++++++ Payment must be created (PaymentService)
//depending on delivery:
//----- Delivery  (In payment service) because in taken credit it already set
use App\Domain\Installment\Services\TakenCreditApiService;
use App\Domain\Order\Interfaces\UserPurchaseStatus;
use App\Domain\Payment\Services\PaymentService;

class PurchaseOrderApiService implements UserPurchaseStatus
{
    private TakenCreditApiService $takenCreditApiService;
    private PaymentService $paymentService;

    public function __construct()
    {
        $this->takenCreditApiService = new TakenCreditApiService();
        $this->paymentService = new PaymentService();
    }

    public function purchase(array $object_data)
    {
        if ($object_data['way_of_payment'] === self::INSTALMENT) {
            return $this->takenCreditApiService->create($object_data);
        } else if ($object_data['way_of_payment'] === self::CASH
            || $object_data['way_of_payment'] === self::CARD) {
            return $this->paymentService->create($object_data);
        }
        return null;
    }

    public function swapPurchasePayment() {

    }
}
