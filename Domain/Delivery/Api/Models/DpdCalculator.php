<?php

namespace App\Domain\Delivery\Api\Models;

use App\Domain\Delivery\Api\Base\DpdClient;
use App\Domain\Delivery\Entities\DeliveryAddress;
use Illuminate\Support\Collection;

/// ask about DPD parcel serviceCode
/// /// Error will be in SoapFault so catch it and display error
class DpdCalculator extends DpdClient
{
    const CALCULATOR = "calculator2?wsdl";

    public function __construct()
    {
        parent::__construct(self::CALCULATOR);
    }

    private function getDelivery(DeliveryAddress $address): array
    {
        $response = [
            'cityId' => $address->availableCities->cityId,
            'cityName' => $address->availableCities->cityName,
            'regionCode' => $address->availableCities->regionCode,
            'countryCode ' => $address->availableCities->countryCode
        ];
        if ($address->index) {
            $response['index'] = $address->index;
        }
        return $response;
    }

    /**
     * calculate the products weight
     */
    private function getWeight(Collection $product): string
    {

        return $product->reduce(function ($cary, $item) {
            return $cary + $item->weight;
        });
    }

    public function getCost(DeliveryAddress $pickUp, DeliveryAddress $delivery, Collection $products)
    {
        $request = [
            "pickup" => $this->getDelivery($pickUp),
            'delivery' => $this->getDelivery($delivery),
            'selfPickup' => false,
            "selfDelivery" => false,
            "weight" => $this->getWeight($products),
            "serviceCode" => "PCL"
        ];
        $response = $this->callSoapMethod($request, "request", "getServiceCost2");
        /***
         * check the status of the response
         */

        return $response['return'];
    }
}
