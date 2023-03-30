<?php

namespace App\Domain\Product\HeaderText\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\HeaderText\Entities\HeaderText;
use App\Domain\Product\HeaderText\Interfaces\HeaderKeyInterface;
use App\Domain\Product\HeaderText\Pivot\HeaderProduct;

class HeaderTextService extends BaseService
{
    public HeaderKeyValueService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new HeaderKeyValueService();
    }

    public function getEntity(): Entity
    {
        return HeaderText::new();
    }

    protected function afterCreateOrUpdateMany($object, $data, $parent, $create)
    {
        $object_data = $this->popCondition($data, HeaderKeyInterface::KEY_VALUE_SERVICE);
        $filter = [
            'product_id' => $parent['product_id'],
            'header_text_id' => $object->id
        ];
        $pivot = HeaderProduct::firstOrCreate($filter, $filter);
        if (!empty($object_data))
            $this->service->createMany($object_data, ['header_product_id' => $pivot->id]);
    }
}
