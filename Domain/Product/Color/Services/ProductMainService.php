<?php

namespace App\Domain\Product\Color\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Color\Entities\ProductMainColor;
use Illuminate\Support\Facades\DB;

class ProductMainService extends BaseService
{

    public function getEntity(): Entity
    {
        return new ProductMainColor();
    }

    private function createImages($object, $object_data)
    {
        if (isset($object_data['images'])) {
            $object->images = $object_data['images'];
            $object->save();
        }
    }

    protected function afterCreateOrUpdateMany($object, $data, $parent, $create)
    {
        $this->createImages($object, $data);
    }

    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $object = parent::create($object_data);
            $this->createImages($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

    }

}
