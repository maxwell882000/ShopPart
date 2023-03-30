<?php

namespace App\Domain\Product\Product\Front\Admin\Attributes;

use App\Domain\Core\File\Attribute\BaseComplex;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\UploadVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Models\VariableGenerator;
use App\Domain\Product\Product\Front\Admin\Functions\FromCategory;
use App\Domain\Product\Product\Front\Admin\Functions\KeyWithMultipleValueExcel;
use App\Domain\Product\Product\Interfaces\ProductInterface;

class KeyWithMultipleValueAttribute extends BaseComplex
{
    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([
            $this->getVariable(),
            FromCategory::new(),
            new UploadVariable(),
            KeyWithMultipleValueExcel::new(),
        ]);
    }


    public function getVariable()
    {
        return VariableGenerator::new([
            sprintf("listeners = [ '%s' => '%s']", FromCategory::FUNCTION_NAME, FromCategory::FUNCTION_NAME)
        ]);
    }

    function getDefaultClassName(): string
    {
        return "ProductCreate";
    }

    function getTitle(): string
    {
        return "Дополнительные данные";
    }

    function key(): string
    {
        return ProductInterface::PRODUCT_KEY_SERVICE;
    }
}
