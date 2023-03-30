<?php

namespace App\Domain\Product\ProductKey\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Product\ProductKey\Services\ProductValueService;

class ProductValueWithPriceDynamic extends ProductValueDynamicWithPriceWithoutEntity
{
    use TableDynamic, TableFilterBy;

    public static function getBaseService(): string
    {
        return ProductValueService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return "product_key_id";
    }

    public function filterByData(): array
    {
        return [
            'order_by_id' => true,
        ];
    }
}
