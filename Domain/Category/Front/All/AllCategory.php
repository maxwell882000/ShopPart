<?php

namespace App\Domain\Category\Front\All;

use App\Domain\Category\Front\Admin\CustomTable\Tables\AllCategoryTable;
use App\Domain\Category\Front\Admin\DropDown\DepthDropDown;
use App\Domain\Category\Front\Main\CategoryIndex;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class AllCategory extends CategoryIndex
{
    use TableFilterBy;

    public function getTableClass(): string
    {
        return AllCategoryTable::class;
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("AllCategory", $this)
        ]);
    }

    public function livewireComponents(): LivewireComponents
    {
        return new AllLivewireComponents([
            DepthDropDown::getDropDown()
        ]);
    }

    function filterByData(): array
    {
        return [
            'order_by_order' => true
        ];
    }
}
