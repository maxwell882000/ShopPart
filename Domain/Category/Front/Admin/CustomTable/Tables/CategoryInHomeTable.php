<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Admin\CustomTable\Traits\CommonCategoryTable;
use App\Domain\Category\Front\Admin\Path\CategoryInHomeRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class CategoryInHomeTable extends AbstractCreateTable
{
    use CommonCategoryTable;

    public function getRouteHandler(): RouteHandler
    {
        return CategoryInHomeRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Иконка"), "icon_table"),
            new Column(__("Название"), "name_table"),
            Column::new(__("Цвет"), "color_index"),
            Column::new(__("Задний цвет"), 'back_color_index')
        ];
    }
}
