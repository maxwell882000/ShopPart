<?php

namespace App\Domain\Product\HeaderText\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\HeaderText\Entities\HeaderKeyValue;
use Illuminate\Support\Facades\Log;

class HeaderKeyValueService extends BaseService
{

    public function getEntity(): Entity
    {
        return HeaderKeyValue::new();
    }

    protected function validateCreateRules(): array
    {
        return [
            'key' => 'required',
            'value' => 'required'
        ];
    }

    protected function createNew(array $object_data)
    {
        $object_data['key'] = $this->popCondition($object_data, "key",
            false, "_");
        $object_data['value'] = $this->popCondition($object_data, "value",
            false
            , "_");
        return parent::createNew($object_data);
    }

    public function update($object, array $object_data)
    {

        $object_data['key'] = $this->popCondition($object_data, "key", false, "_");
        $object_data['value'] = $this->popCondition($object_data, "value", false, "_");
        return parent::update($object, $object_data);
    }
}
