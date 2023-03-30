<?php

namespace App\Domain\Product\Product\Front\Moderator\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Admin\CustomTable\Tables\ProductTable;
use App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler;

class ModeratorProductTable extends ProductTable
{
    public function getRouteHandler(): RouteHandler
    {
        return ModeratorProductRouteHandler::new();
    }
}
