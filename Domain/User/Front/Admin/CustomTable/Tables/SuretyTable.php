<?php

namespace App\Domain\User\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\User\Front\Admin\Path\SuretyRouteHandler;

class SuretyTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return SuretyRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Имя поручителя"), "name_index"),
            new Column(__("Телефон"), "phone_index"),
        ];
    }
}
