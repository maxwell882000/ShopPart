<?php


namespace App\Domain\Category\Front\Admin\CustomTable\Tables;


use App\Domain\Category\Front\Admin\CustomTable\Traits\CommonCategoryTable;
use App\Domain\Category\Front\Admin\Functions\DraggableFunction;
use App\Domain\Category\Front\Admin\Path\CategoryRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\CustomTable\Traits\HasDraggable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

// only this is needed
class CategoryTable extends AbstractCreateTable
{
    use CommonCategoryTable, HasDraggable;

    public function getColumns(): array
    {
        return [
            ...$this->getCommonColumns(),
        ];
    }

    public function getRouteHandler(): RouteHandler
    {
        return CategoryRouteHandler::new();
    }

    public function functionObject(): AbstractFunction
    {
        return new DraggableFunction();
    }
}
