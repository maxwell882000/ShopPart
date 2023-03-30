<?php

namespace App\Domain\Common\Brands\Front\Admin\CustomTable\Models;

use App\Domain\Common\Brands\Front\Admin\Path\BrandRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BrandTable extends AbstractCreateTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Название"), "brand_index"),
            Column::new(__("Лого"), "logo_index")
        ];
    }

    public function getRouteHandler(): RouteHandler
    {
        return BrandRouteHandler::new();
    }
}
