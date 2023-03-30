<?php

namespace App\Domain\Category\Front\SubCategory;

use App\Domain\Category\Front\Admin\CustomTable\Action\Models\SubCategoryDeleteAction;
use App\Domain\Category\Front\Admin\CustomTable\Action\Models\SubCategoryEditAction;
use App\Domain\Category\Front\Admin\CustomTable\Tables\SubCategoryTable;
use App\Domain\Category\Front\Main\CategoryIndex;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

// all names will be taken from this table
class SubCategory extends CategoryIndex
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("SubCategory", $this)
        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            SubCategoryEditAction::new([$this->id]),
            SubCategoryDeleteAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return SubCategoryTable::class;
    }

    public function getTitle(): string
    {
        return 'Подкатегории от';
    }

    public function addTitle()
    {
        return sprintf('%s::find($params)->name_current', self::class);
    }

    public function filterByData(): array
    {
        return [
            'parent_id' => '$params'
        ];
    }
}
