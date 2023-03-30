<?php

namespace App\Domain\Product\Product\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableNested;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Interfaces\FrontEntityInterface;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductAcceptTable;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductDeclineTable;
use App\Domain\Product\Product\Front\Traits\ProductCommonTableAttributes;

class ProductNested extends Product implements FrontEntityInterface
{
    use TableNested, ProductCommonTableAttributes;

    public function getTableClass(): string
    {
        return ProductAcceptTable::class;
    }

    public function tableDeclineClass(): string
    {
        return ProductDeclineTable::class;
    }

}
