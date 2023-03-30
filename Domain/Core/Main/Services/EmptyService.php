<?php

namespace App\Domain\Core\Main\Services;

use App\Domain\Core\Main\Entities\Entity;

class EmptyService extends BaseService
{

    public function getEntity(): Entity
    {
        return Entity::new();
    }

    public function create(array $object_data)
    {
    }

    public function update($object, array $object_data)
    {

    }

    public function destroy($object): bool
    {
    }
}
