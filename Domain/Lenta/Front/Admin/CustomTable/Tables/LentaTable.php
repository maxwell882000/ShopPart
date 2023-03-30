<?php

namespace App\Domain\Lenta\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Lenta\Front\Admin\Path\LentaRouteHandler;

class LentaTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return LentaRouteHandler::new();
    }

    public function getColumns(): array
    {
        return  [
            Column::new(__("Название RU"), 'lenta_ru'),
            Column::new(__("Название UZ"), 'lenta_uz'),
//            Column::new(__("Название EN"), 'lenta_en')
            Column::new(__("Количество продуктов"), 'lenta_number')
        ];
    }
}
