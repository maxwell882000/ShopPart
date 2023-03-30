<?php

namespace App\Domain\Delivery\Api\Models;

use App\Domain\Category\Entities\Category;
use App\Domain\Delivery\Api\Base\DpdClient;
use App\Domain\Delivery\Api\Exceptions\DpdException;
use App\Domain\Delivery\Api\Interfaces\DpdExceptionInterface;
use App\Domain\Delivery\Api\Traits\OrderTrait;
use App\Domain\Delivery\Entities\Delivery;
use App\Domain\Delivery\Entities\DeliveryAddress;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Order\Interfaces\UserPurchaseStatus;
use App\Domain\Shop\Entities\ShopAddress;
use App\Domain\Shop\Entities\WorkTimes;
use App\Domain\User\Entities\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

// create one field in category boolean weather all products in this category is considered as important
// .Then, loop over the products and if there is the product which belongs to category having important mark
//  make cargoRegistered as important

// if workTimes is not exists throw exception

// decide how to make serviceCode and this is ready

// check how it is works
class DpdOrder extends DpdClient
{
    use OrderTrait;

    /**
     * @return  Delivery
     */
    const NUM_DAYS_WEEK = 7;
    const ORDER = "order2?wsdl";

    public function __construct()
    {
        parent::__construct(self::ORDER);
    }

    private function checkOnError(array &$response)
    {
        $status = $response['return']['status'][0];
        if (!isset(DpdExceptionInterface::STATUS_TO_DB[$status])) {
            if (isset(DpdExceptionInterface::EXCEPTION[$status])) {
                throw  new DpdException(__(DpdExceptionInterface::EXCEPTION[$status]), $status);
            } else {
                throw new DpdException($response['return']['errorMessage'], $status);
            }
        } else {
            $response['return']['status'] = DpdExceptionInterface::STATUS_TO_DB[$status];
        }
    }

    private function getPaymentType(array &$request, UserPurchase $purchase)
    {
        if ($purchase->status % 10 == UserPurchaseStatus::CASH) {
            $request['order']['paymentType'] = "ОУП";
        }
    }

    private function receiverAddress(UserPurchase $purchase, DeliveryAddress $address)
    {
        $receiver = $address->toArray();
        $receiver['name'] = $purchase->user->userCreditData->name ?? $purchase->user->phone;
        $receiver['contactPhone'] = $purchase->user->phone;
        $receiver['contactFio'] = $receiver['name'];
//        $receiver['code'] = "123213";
//        unset($receiver['city']);
        return $receiver;
    }

//•	ОУП – оплата у получателя наличными
//•	ОУО – оплата у отправителя наличными
//•	Оплата по безналичному расчету отправителем (автоматически, если не передавать paymentType)
    // delivery will be created after this method
    public function createOrder(ShopAddress $fromAddress, DeliveryAddress $toAddress, UserPurchase $purchase, Collection $purchases)
    {
        $categories = $this->purchaseToCategory($purchases);
        $dateAndWorkTime = $this->calculateDatePickUp($fromAddress->workTime()->orderBy("day")->get());
        $datePickUp = [
            'datePickup' => $dateAndWorkTime[0],
            'senderAddress' => $this->generateSenderAddress($dateAndWorkTime[1], $fromAddress),
            'pickupTimePeriod' => "9-18",
        ];
        $request = [
            'order' => [
                'orderNumberInternal' => $this->orderNumberInternal($fromAddress->id, $purchase->id),
                'serviceCode' => "PCL",
                'serviceVariant' => "ДД",
                "cargoNumPack" => $purchases->sum("quantity"),
                'cargoWeight' => $this->calculateWeight($purchases),
                "cargoRegistered" => $this->categoriesIsRegistered($categories),
                "cargoCategory" => $categories->map(function ($item) {
                    return $item->name['ru'];
                })->join(', '),
                "receiverAddress" => $this->receiverAddress($purchase, $toAddress),
                "returnAddress" => $this->generateSenderAddress($dateAndWorkTime[1], $fromAddress),
//                'extraParam' => [
//                    [
//                        'name' => 'pickup_city_id',
//                        'value' => $fromAddress->delivery->availableCities->cityId,
//                    ],
//                    [
//                        'name' => 'deliver_city_id',
//                        'value' => $toAddress->availableCities->cityId
//                    ],
//                ],
            ]
        ];
        $request['header'] = $datePickUp;
        $this->getPaymentType($request, $purchase);
        $response = $this->callSoapMethod($request, "orders", "createOrder");
        Log::info("DELIVERT CREATED");
        Log::info($response);
        $this->checkOnError($response);
        Log::info("DELIVERT CREATED");
        Log::info($response);
        return array_merge($response['return'], $datePickUp);
    }

    public function getOrderStatus(Delivery $delivery)
    {
        $request = [
            'order' => [
                'orderNumberInternal' => $this->orderNumberInternal($delivery->shop_id, $delivery->user_purchase_id),
                'datePickup' => $delivery->datePickup,
            ]
        ];
        $response = $this->callSoapMethod($request, "orderStatus", "getOrderStatus");
        $this->checkOnError($response);
        return $response;
    }

    public function cancelOrder(Delivery $delivery)
    {
        $request = [
            "cancel" => [
                "orderNumberInternal" => $this->orderNumberInternal($delivery->shop_id, $delivery->user_purchase_id),
                'orderNum' => $delivery->orderNum,
                "pickupdate" => $delivery->datePickup
            ]
        ];
        $response = $this->callSoapMethod($request, "orders", "cancelOrder");
        $this->checkOnError($response);
        return $response;
    }
}
