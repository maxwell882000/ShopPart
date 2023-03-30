<?php

namespace App\Domain\Product\ProductKey\Front\Dynamic;

use App\Domain\Core\File\Interfaces\LivewirePassVariableToTag;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\ProductKey\Entities\ProductValue;
use App\Domain\Product\ProductKey\Front\CustomTables\ProductValueTable;
use App\Domain\Product\ProductKey\Front\Traits\TextDynamicWithoutEntity;
use App\Domain\Product\ProductKey\Interfaces\ProductKeyInterface;

class ProductValueDynamicWithoutEntity extends ProductValue implements TableInFront, LivewirePassVariableToTag
{
    use TextDynamicWithoutEntity;

    static public function getPrefixInputHidden(): string
    {
        return ProductInterface::PRODUCT_KEY_TO . '%s->' . ProductKeyInterface::VALUE;
    }

    public function getTitle(): string
    {
        return "Значения";
    }

    public function getTableClass(): string
    {
        return ProductValueTable::class;
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            VariableGenerator::new(["index"])
        ]);
    }

    public function generateAdditionalToHtml(): array
    {
        return [
            "index",
            "wire:key" => 'index ."key_with_multiple_key"'
        ];
    }
}
