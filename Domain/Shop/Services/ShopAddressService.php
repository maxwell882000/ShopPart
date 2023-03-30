<?php

namespace App\Domain\Shop\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Delivery\Services\DeliveryAddressService;
use App\Domain\Shop\Entities\ShopAddress;
use App\Domain\Shop\Interfaces\ShopRelationInterface;
use Illuminate\Support\Facades\DB;

class ShopAddressService extends BaseService implements ShopRelationInterface
{
    public WorkTimesService $workTimesService;
    public DeliveryAddressService $addressService;

    public function __construct()
    {
        parent::__construct();
        $this->workTimesService = new WorkTimesService();
        $this->addressService = new DeliveryAddressService();
    }

    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $works = $this->popCondition($object_data, self::WORK_TIME);
            $delivery = $this->popCondition($object_data, self::DELIVERY_ADDRESS);
            $delivery_object = $this->addressService->create($delivery);
            $object = $this->createWith($object_data, [
                'delivery_address_id' => $delivery_object->id
            ]);
            $this->workTimesService->createMany($works, [
                'shop_address_id' => $object->id
            ]);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }

    public function update($object, array $object_data)
    {
        try {
            DB::beginTransaction();
            $delivery = $this->popCondition($object_data, self::DELIVERY_ADDRESS);
            $this->addressService->update($object[self::DELIVERY_ADDRESS], $delivery);
            $object = parent::update($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function getEntity(): Entity
    {
        return new ShopAddress();
    }
}
