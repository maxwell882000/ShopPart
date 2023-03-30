<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Domain\CreditProduct\Api\MainCreditProductApi;
use App\Http\Controllers\Api\Base\ApiController;

class WayOfPaymentController extends ApiController
{
    public function getPayments()
    {
        return
            $this->result([
                'credit' => MainCreditProductApi::byProducts($this->request->product_ids)->get()
            ]);
    }
}
