<?php

namespace App\Domain\Category\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Product\ProductKey\Services\ProductKeyService;

class FiltrationKeyCategoryDynamic extends FiltrationKeyCategoryDynamicWithoutEntity
{
    use TableDynamic;

    public static function getCustomRules(): array
    {
        return [
            'text_ru' => DynamicAttributes::INPUT,
            "text_uz" => DynamicAttributes::INPUT,
            "text_en" => DynamicAttributes::INPUT,
        ];
    }

    public function getCustomFrontRules(): array
    {
        return [
            'text_ru' => null,
            "text_uz" => null,
            "text_en" => null,
        ];
    }

    public static function getBaseService(): string
    {
        return ProductKeyService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return "category_id";
    }
}
