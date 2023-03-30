<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Domain\Delivery\Api\Entities\AvailableCitiesApi;
use App\Domain\Delivery\Api\Services\OrderService;
use App\Domain\Shop\Api\ShopMap;
use App\Http\Controllers\Api\Base\ApiController;

class DeliveryController extends ApiController
{
    private OrderService $orderService;

    public function __construct()
    {
        parent::__construct();
    }

    public function searchCity(): \Illuminate\Http\JsonResponse
    {
        return $this->result([
            "city" => AvailableCitiesApi
                ::filterBy($this->request->all())
                ->take(10)
                ->get()
        ]);
    }

    public function searchShop(): \Illuminate\Http\JsonResponse
    {
        return $this->result([
            'shop' => ShopMap::scopeCloseTo($this->request->all())->get()
        ]);
    }

    public function getShops(): \Illuminate\Http\JsonResponse
    {
        return $this->result([
            'shop' => ShopMap::byProducts($this->request->product_ids)->get()
        ]);
    }

    public function calculateDeliveryPrice()
    {
        $this->orderService = new OrderService();
        return $this->saveResponse(function () {
            return $this->result($this->orderService->calculatePriceFull($this->request->all()));
        });
    }

}
