<?php

namespace App\Domain\Product\Product\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\InputTableAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableNested;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Interfaces\FrontEntityInterface;
use App\Domain\Core\Front\Js\Interfaces\FilterJsInterface;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductAcceptTable;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductNestedDeclineTable;
use App\Domain\Product\Product\Front\Admin\Livewire\Attribute\ModelProductAttribute;
use App\Domain\Product\Product\Front\Traits\ProductCommonTableAttributes;

class ProductInstallmentNested extends Product implements FrontEntityInterface
{
    use TableNested, ProductCommonTableAttributes;

    public function getTableClass(): string
    {
        return ProductAcceptTable::class;
    }

    public function tableDeclineClass(): string
    {
        return ProductNestedDeclineTable::class;
    }

    public function getTakeNumberAttribute(): string
    {
        return InputTableAttribute::generate(
            'current_number',
            "text",
            'entitiesStore.' . $this->id,
            false,
            FilterJsInterface::ONLY_NUMBER,
            "number_nested_" . $this->id,
        );
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            new ModelProductAttribute()
        ]);
    }
}
