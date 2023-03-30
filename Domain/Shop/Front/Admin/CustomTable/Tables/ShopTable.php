<?php

namespace App\Domain\Shop\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Shop\Front\Admin\Path\ShopRouteHandler;

class ShopTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return ShopRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Лого"), "logo_index"),
            Column::new(__("Название"), "name_index"),
            Column::new(__("Телефоный номер"), "phone_index"),
            Column::new(__("Товары магазина"), "product_index"),
        ];
    }
}
