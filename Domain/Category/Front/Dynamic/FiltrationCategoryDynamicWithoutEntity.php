<?php

namespace App\Domain\Category\Front\Dynamic;

use App\Domain\Category\Entities\FiltrationCategory;
use App\Domain\Category\Front\Admin\CustomTable\Tables\FiltrationCategoryTable;
use App\Domain\Category\Front\Admin\DropDown\FiltrationCategoryDropDown;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

class FiltrationCategoryDynamicWithoutEntity extends FiltrationCategory implements TableInFront
{
    use TableDynamicWithoutEntity;

    /**
     * @throws \App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException
     */
    public static function getCustomRules(): array
    {
        return [
            'key' => DynamicAttributes::INPUT,
            'attribute' => DynamicAttributes::DROP_DOWN(FiltrationCategoryDropDown::class),
        ];
    }

    public function getCustomFrontRules(): array
    {
        return [
            'key' => null,
            'attribute' => fn($value) => self::DB_TO_FRONT[$this->attribute],
        ];
    }


    public function getTitle(): string
    {
        return 'Фильтрация для продуктов';
    }


    public function getTableClass(): string
    {
        return FiltrationCategoryTable::class;
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

    public static function getPrefixInputHidden(): string
    {
        return "filtration";
    }
}
