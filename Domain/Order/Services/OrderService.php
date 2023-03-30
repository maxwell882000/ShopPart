<?php

namespace App\Domain\Order\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Order\Entities\Order;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    public function getEntity(): Entity
    {
        return new Order();
    }

    public function createWith(array $object_data, array $additional)
    {
        return $this->transaction(function () use ($object_data, $additional) {
            $object = parent::createWith($object_data, $additional);
            auth()->user()->basket()->attach($object);
            return $object;
        });

    }

    public function updateParams($order, array $object_data)
    {
        if (isset($object_data['additional'])) {
            $additional = $object_data['additional'];
            $add = $order->order['additional'] ?? [];
            $add[$additional['key']] = $additional['value'];
            $order->order = [
                'additional' => $add
            ];
            $order->price = $order->price + intval($additional['value']['value']['price']) - intval($additional['value']['value']['oldPrice']);
            Log::info("PRICE");
            Log::info($order->price);
        }
        if (isset($object_data['colors'])) {
            $order->order = ['colors' => $object_data['colors']];
        }
        $order->save();
    }
}
