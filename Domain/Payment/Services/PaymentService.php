<?php

namespace App\Domain\Payment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Order\Services\UserPurchaseFromOrderService;
use App\Domain\Payment\Payable\PaymentPayable;
use Illuminate\Support\Facades\Log;

// has to be written logic to create payment

class PaymentService extends BaseService
{
    private PaymentCardService $cardService;
    private UserPurchaseFromOrderService $fromOrderService;

    public function __construct()
    {
        parent::__construct();
        $this->cardService = PaymentCardService::new();
        $this->fromOrderService = UserPurchaseFromOrderService::new();
    }

    public function getEntity(): Entity
    {
        return new PaymentPayable();
    }

    public function create(array $object_data)
    {
        return $this->transaction(function () use ($object_data) {
            $object_data['user_id'] = auth("sanctum")->user()->id;
            $purchase = $this->fromOrderService->create($object_data);
            $object_data['purchase_id'] = $purchase->id;
            $object_data['price'] = $purchase->sumPurchases() + $purchase->sumDelivery();
//            dd($object_data);
            $object = parent::create($object_data);
            $object_data['payment_id'] = $object->id;
            if ($purchase->isCard()) // in the case if it was paid by card we have to remember transaction_id
                // for any operation if it is needed
                $this->cardService->create($object_data);
            return $object;
        });
    }
}
