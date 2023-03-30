<?php

namespace App\Domain\Product\ProductKey\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\ProductKey\Front\CustomTables\ProductValueTableWithPrice;
use App\Domain\Product\ProductKey\Interfaces\ProductKeyInterface;

class ProductValueDynamicWithPriceWithoutEntity extends ProductValueDynamicWithoutEntity
{
    static public function getPrefixInputHidden(): string
    {
        return ProductInterface::PRODUCT_KEY_TO . '%s->' . ProductKeyInterface::VALUE_CHOICE;
    }

    public static function getCustomRules(): array
    {
        return [
            'text_ru' => DynamicAttributes::INPUT,
            "text_uz" => DynamicAttributes::INPUT,
            'price' => DynamicAttributes::INPUT,
//            "text_en" => DynamicAttributes::INPUT,
        ];
    }

    public function getTableClass(): string
    {
        return ProductValueTableWithPrice::class;
    }
    public function generateAdditionalToHtml(): array
    {
        return [
            "index",
            "wire:key" => 'index ."key_with_multiple_key_with_price"'
        ];
    }
    public function getCustomFrontRules(): array
    {
        return [
            "text_ru" => null,
            "text_uz" => null,
            'price' => null,
//            "text_en" => null,
        ];
    }
}
