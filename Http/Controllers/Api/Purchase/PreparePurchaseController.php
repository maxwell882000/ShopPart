<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Domain\Core\Main\Traits\HasPopKey;
use App\Domain\Delivery\Api\Entities\AvailableCitiesApi;
use App\Domain\Delivery\Api\Services\OrderService;
use App\Domain\Delivery\Entities\AvailableCities;
use App\Domain\Order\Services\PurchaseOrderApiService;
use App\Domain\Shop\Api\ShopMap;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;

class PreparePurchaseController extends ApiController
{
    private $purchaseService;

    public function __construct(PurchaseOrderApiService $purchaseService)
    {
        parent::__construct();
        $this->purchaseService = $purchaseService;
    }

    public function store()
    {
        return $this->saveResponse(function () {
            return $this->result($this->purchaseService->purchase($this->request->all()));
        });
    }
}
