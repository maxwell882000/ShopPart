<?php

namespace App\Domain\User\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\User\Front\Admin\Path\AdminUserRouteHandler;

class AdminTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return AdminUserRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Номер телефона"), "phone_index"),
            Column::new(__("Статус"), "status_index"),
        ];
    }
}
