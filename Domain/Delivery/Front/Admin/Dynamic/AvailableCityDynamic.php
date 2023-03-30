<?php

namespace App\Domain\Delivery\Front\Admin\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Delivery\Entities\AvailableCities;
use App\Domain\Delivery\Front\Admin\Table\AvailableCityTable;
use App\Domain\Delivery\Services\AvailableCitiesService;

class AvailableCityDynamic extends AvailableCities
{
    use TableDynamic;

    public function getCustomFrontRules(): array
    {
        return [
            'cityNameUz' => null,
            'cityNameRu' => null
        ];
    }

    public function getTableClass(): string
    {
        return AvailableCityTable::class;
    }

    public static function getCustomRules(): array
    {
        return [
            'cityNameUz' => DynamicAttributes::INPUT,
            'cityNameRu' => DynamicAttributes::INPUT
        ];
    }

    public function attributesToArray(): array
    {
        $parent = parent::attributesToArray();
        $parent['cityNameUz'] = $this->getCityNameUzAttribute();
        $parent['cityNameRu'] = $this->getCityNameRuAttribute();
        return $parent;
    }

    public static function getBaseService(): string
    {
        return AvailableCitiesService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return "";
    }

    public function getTitle(): string
    {
        return "Доступные города";
    }
}
