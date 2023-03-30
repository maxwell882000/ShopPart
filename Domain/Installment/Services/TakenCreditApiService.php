<?php

namespace App\Domain\Installment\Services;

use App\Domain\Order\Services\UserPurchaseFromOrderService;

class TakenCreditApiService extends TakenCreditService
{
    public function __construct()
    {
        parent::__construct();
        $this->purchaseService = new UserPurchaseFromOrderService();
    }

    protected function userData(&$object_data)
    {
        $user = auth("sanctum")->user();
        $object_data['user_id'] = $user->id;
        $object_data['user_credit_data_id'] = $user->userCreditData->id;
    }
}
