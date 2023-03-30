<?php

namespace App\Domain\Delivery\Api\Services;

use App\Domain\Core\Main\Traits\HasPopKey;
use App\Domain\Delivery\Api\Exceptions\DpdException;
use App\Domain\Delivery\Api\Interfaces\DpdExceptionInterface;
use App\Domain\Delivery\Api\Models\DpdCalculator;
use App\Domain\Delivery\Api\Models\DpdOrder;
use App\Domain\Delivery\Entities\Delivery;
use App\Domain\Delivery\Entities\DeliveryAddress;
use App\Domain\Delivery\Services\DeliveryService;
use App\Domain\Delivery\Services\OrderDeliveryService;
use App\Domain\Order\Entities\Order;
use App\Domain\Order\Entities\Purchase;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Shop\Entities\Shop;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

// write the service
class OrderService
{
    use HasPopKey;

    private DpdOrder $dpdOrder;
    private DpdCalculator $dpdCalculator;
    private DeliveryService $deliveryPurchaseService;
    private OrderDeliveryService $deliveryOrderService;

    public function __construct()
    {
        $this->dpdOrder = new DpdOrder();
        $this->dpdCalculator = new DpdCalculator();
        $this->deliveryPurchaseService = new DeliveryService();
        $this->deliveryOrderService = new OrderDeliveryService();
    }


    public function calculatePriceFull(array $object_data)
    {
        $orders = Order::whereIn("id", $object_data['order_ids'])->get();
        $delivery_data = $this->popConditionMultiple($object_data, ['purchase', 'delivery_address']);
        $delivery = new DeliveryAddress($delivery_data);
        return $this->calculatePrice($orders, $delivery);
    }

    /**
     * @param Collection<Order> $orders
     * @param DeliveryAddress $address -- server must send data about delivery
     * just create eloquent without saving it in DATABASE
     * @return array price, different_shops
     */
    /**
     *  first orders got than it transforms to purchases
     */
    public function calculatePrice(Collection $orders, DeliveryAddress $address): array
    {

        // transforming order is required for getting shop_id and weight
        // can be easily rewritten to improve performance using JOIN
        $products = $orders->transform(function (Order $item) {
            $item->shop_id = $item->product->shop_id;
            $item->weight = $item->product->weight * $item->quantity;
            return $item;
        })->groupBy("shop_id");
        $price = 0;
        try {
            DB::beginTransaction();
            foreach ($products as $shop_id => $order) {
                $delivery = $this->dpdCalculator->getCost(
                    Shop::find($shop_id)->shopAddress->delivery,
                    $address,
                    $order
                );
                $orderDelivery = $this->deliveryOrderService->create($delivery);
                Order::whereIn('id', $order->pluck('id'))->update([
                    'order_delivery_id' => $orderDelivery->id
                ]);
                $price = $orderDelivery->price + $price;
            }
            DB::commit();
            // different shops --- products will be send from different locations
            return ['price' => $price, 'different_shop' => $products->count() > 1];
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

    }

    public function createOrder(UserPurchase $userPurchase)
    {
        try {
            $deliveryTo = $userPurchase->delivery_address;
            $shop_purchases = Purchase::byUserPurchaseWithShopId($userPurchase->id)->get()->groupBy("shop_id");
            DB::beginTransaction();
            foreach ($shop_purchases as $shop_id => $purchase) {
                try {
                    $shop_address = Shop::find($shop_id)->shopAddress;
                    $response = $this->dpdOrder->createOrder(
                        $shop_address,
                        $deliveryTo,
                        $userPurchase,
                        $purchase);
                    $this->deliveryPurchaseService->create([
                        "user_purchase_id" => $userPurchase->id,
                        "shop_address_id" => $shop_address->id,
                        'orderNum' => isset($response['orderNum']) ? $response['orderNum'][0] : null,
                        "status" => $response['status'],
                        "datePickup" => $response['datePickup']
                    ]);
                } catch (DpdException $exception) {
                    $all = $userPurchase->delivery;
                    foreach ($all as $item) {
                        try {
                            $this->dpdOrder->cancelOrder($item);
                        } catch (DpdException $exception) {
                        }
                    }
                    throw  $exception;
                }
            }
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }

    public function cancelOrderByPurchase(UserPurchase $purchase)
    {
        foreach ($purchase->delivery as $item) {
            $this->cancelOrder($item);
        }
    }

    public function cancelOrder(Delivery $delivery)
    {
        try {
            $result = $this->dpdOrder->cancelOrder($delivery);
            $delivery->status = $result['result']['status'];
            $delivery->save();
        } catch (DpdException $exception) {
            // save all errors , show if any delivery could not be canceled
            // in admin panel
            if (isset(DpdExceptionInterface::ERROR_STATUS_TO_DB[$exception->getError()])) {
                $delivery->status = DpdExceptionInterface::ERROR_STATUS_TO_DB[$exception->getError()];
                $delivery->errors = $exception->getMessage();
            }
            $delivery->save();
        }

    }

}
