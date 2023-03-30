<?php

namespace App\Domain\Common\Discounts\Services;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Common\Discounts\Interfaces\DiscountRelation;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\File\Traits\FileUploadTemp;
use Illuminate\Support\Facades\DB;

class DiscountService extends BaseService implements DiscountRelation
{
    use FileUploadService;

    public function getEntity(): Entity
    {
        return Discount::new();
    }

    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $this->serializeTempFile($object_data);
            $object_data['des_image'] = $this->popCondition($object_data, "des_image");
            $object_data['mob_image'] = $this->popCondition($object_data, "mob_image");
            $product = collect($this->popCondition($object_data,  self::PRODUCT_SERVICE))->collapse()->toArray();
            $object = parent::create($object_data);
            $object->product()->attach($product);
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
            $this->serializeTempFile($object_data);
            $object_data['des_image'] = $this->popCondition($object_data, "des_image");
            $object_data['mob_image'] = $this->popCondition($object_data, "mob_image");
            $object = parent::update($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }
}

