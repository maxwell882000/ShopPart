<?php

namespace App\Domain\Product\ProductKey\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\ProductKey\Entities\ProductKey;

class ProductKeyService extends BaseService
{

    public function getEntity(): Entity
    {
        return new ProductKey();
    }

    public function create(array $object_data)
    {

        $object = parent::create($object_data);
        $object->filtration()->attach($object_data['category_id']);
        return $object;
    }

    public function createMany(array $object_data, array $parent, int $start = 1)
    {
        for ($i = $start; !empty($object_data); $i++) {
            $data = $this->popCondition($object_data, $i);
            if (!empty($data)) {
                $this->create(array_merge($data, $parent));
            }
        }
    }
}
