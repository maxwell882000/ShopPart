<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Admin\CustomTable\Traits\CommonCategoryTable;
use App\Domain\Category\Front\Admin\Functions\DraggableFunction;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\BaseTable;
use App\Domain\Core\Front\Admin\CustomTable\Traits\HasDraggable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;

class AllCategoryTable extends AbstractTable
{
    use CommonCategoryTable, HasDraggable;

    public function getColumns(): array
    {
        return [
            ...$this->getCommonColumns()
        ];
    }

    public function functionObject(): AbstractFunction
    {
       return  DraggableFunction::new();
    }
}
