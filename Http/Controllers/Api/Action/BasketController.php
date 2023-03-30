<?php

namespace App\Http\Controllers\Api\Action;

use App\Domain\Order\Entities\Order;
use App\Domain\Order\Services\OrderService;
use App\Domain\Product\Product\Entities\Product;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;

class BasketController extends ApiController
{
    private OrderService $service;

    public function __construct()
    {
        $this->service = new OrderService();
        parent::__construct();
    }

    /**
     *  Request may contain
     *  quantity
     *  order    -- json where might be about color
     *  for know just put everything in || description ||
     */
    public function basket(Request $request, Product $product)
    {
        $order = $this->getBasket($product);
        if ($order) {
            return $this->result($order);
        }
        return $this->saveResponse(function () use ($product, $request) {
            $object_data = [
                "product_id" => $product->id,
            ];
            $object = $this->service->createWith($object_data, $request->all());
            return $this->result($object);
        });
    }

    // for quantity
    public function updateOrder(Request $request, Order $order)
    {
        return $this->saveResponse(function () use ($request, $order) {
            $this->service->update($order, $request->all());
        });
    }

    public function updateOrderSelect(Request $request, Order $order)
    {

        $this->service->updateParams($order, $request->all());
    }

    protected function getBasket($product)
    {
        $user = auth()->user();
        $object = $user->basket()->where('orders.product_id', $product->id);
        return $object->first();
    }

    public function removeBasket(Request $request, Product $product)
    {
        $order = $this->getBasket($product);
        if ($order)
            $order->delete();
    }

    public function destroyOrder(Order $order)
    {
        return $this->saveResponse(function () use ($order) {
            $this->service->destroy($order);
        });
    }

    public function massDestroyOrder(Request $request)
    {
        $this->saveResponse(function () use ($request) {
            $this->validateRequest([
                "ids" => "required|array",
            ]);
            Order::whereIn("id", $request->ids)->delete();
        });
    }
}
