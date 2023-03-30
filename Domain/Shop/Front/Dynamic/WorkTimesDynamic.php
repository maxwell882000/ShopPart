<?php

namespace App\Domain\Shop\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Shop\Front\Admin\DropDown\DayDropDown;
use App\Domain\Shop\Interfaces\DayInterface;
use App\Domain\Shop\Services\WorkTimesService;

class WorkTimesDynamic extends WorkTimesDynamicWithoutEntity
{
    use TableDynamic;

    public function getCustomFrontRules(): array
    {
        return [
            "day" => fn($value) => DayInterface::DB_TO_FRONT[$value],
            "workTimeFrom" => null,
            "workTimeTo" => null
        ];
    }
    public static function getCustomRules(): array
    {
        return [
            "day" => DynamicAttributes::DROP_DOWN(DayDropDown::class),
            "workTimeFrom" => DynamicAttributes::INPUT("number"),
            "workTimeTo" => DynamicAttributes::INPUT("number")
        ];
    }
    public static function getBaseService(): string
    {
        return WorkTimesService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return "shop_address_id";
    }
}
