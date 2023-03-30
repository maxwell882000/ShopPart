<?php

namespace App\Domain\Shop\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Shop\Entities\WorkTimes;
use App\Domain\Shop\Front\Admin\CustomTable\Tables\WorkTimesDynamicTable;
use App\Domain\Shop\Front\Admin\DropDown\DayDropDown;
use App\Domain\Shop\Interfaces\DayInterface;
use App\Domain\Shop\Interfaces\ShopRelationInterface;
use App\Domain\Shop\Services\WorkTimesService;

class WorkTimesDynamicWithoutEntity extends WorkTimes implements TableInFront, ShopRelationInterface
{
    use TableDynamicWithoutEntity;

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

    public function getTableClass(): string
    {
        return WorkTimesDynamicTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getTitle(): string
    {
        return "Дни работы";
    }




    static public function getPrefixInputHidden(): string
    {
        return self::ADDRESS_TO_WORK_TIME_TO;
    }
}
