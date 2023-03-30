<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\PhoneCode;

class PhoneCodeService extends BaseService
{

    public function getEntity(): Entity
    {
        return PhoneCode::new();
    }

    private function setCode(array &$object_data)
    {
        $object_data['code'] = rand(100000, 999999);
    }

    public function createOrUpdate($object, $key, array $object_data, array $addition = [])
    {
        $this->setCode($object_data);
        return parent::createOrUpdate($object, $key, $object_data, $addition);
    }

}
