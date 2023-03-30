<?php

namespace App\Domain\Category\Front\Nested;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Admin\CustomTable\Tables\CategoryAcceptTable;
use App\Domain\Category\Front\Admin\CustomTable\Tables\CategoryDeclineTable;
use App\Domain\Category\Front\Traits\CategoryAttributeTable;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFrontNested;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableNested;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Interfaces\FrontEntityInterface;

class CategoryNested extends Category implements FrontEntityInterface
{
    use TableNested, CategoryAttributeTable;


    public function getTableClass(): string
    {
        return CategoryAcceptTable::class;
    }

    public function tableDeclineClass(): string
    {
        return CategoryDeclineTable::class;
    }

}
