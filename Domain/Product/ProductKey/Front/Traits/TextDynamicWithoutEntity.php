<?php

namespace App\Domain\Product\ProductKey\Front\Traits;

use App\Domain\Category\Front\Admin\CustomTable\Tables\FiltrationKeyCategoryTable;
use App\Domain\Category\Interfaces\CategoryRelationInterface;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

trait   TextDynamicWithoutEntity
{
    use TableDynamicWithoutEntity;

    public static function getCustomRules(): array
    {
        return [
            'text_ru' => DynamicAttributes::INPUT,
            "text_uz" => DynamicAttributes::INPUT,
//            "text_en" => DynamicAttributes::INPUT,
        ];
    }

    public function getCustomFrontRules(): array
    {
        return [
            "text_ru" => null,
            "text_uz" => null,
//            "text_en" => null,
        ];
    }



    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }



    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([]);
    }
}
