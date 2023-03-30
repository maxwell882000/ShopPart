<?php

namespace App\Domain\Product\ProductKey\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use App\Domain\Product\ProductKey\Interfaces\ProductKeyInterface;
use App\Domain\Product\ProductKey\Pivot\ProductKeyProducts;
use Illuminate\Support\Facades\Log;

class ProductKeyProductService extends BaseService
{
    public ProductValueService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new ProductValueService();
    }

    public function getEntity(): Entity
    {
        return new ProductKey();
    }

    protected function afterCreateOrUpdateMany($object, $data, $parent, $create)
    {

        $object_data = $this->popCondition($data, intval($object->type) == 0 ? ProductKeyInterface::VALUE_CHOICE
            : ProductKeyInterface::VALUE);
        $filter = [
            'product_id' => $parent['product_id'],
            'products_key_id' => $object->id
        ];
        $pivot = ProductKeyProducts::firstOrCreate($filter, $filter);
        Log::info("afterCreateOrUpdateMany");
        Log::info($object_data);
        Log::info($data);
        if (!empty($object_data))
            $this->service->createMany($object_data, ['product_key_id' => $pivot->id]);

    }
}
