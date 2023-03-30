<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Admin\Path\SubCategoryRouteHandler;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class SubCategoryTable extends CategoryTable
{
    public function getRouteHandler(): RouteHandler
    {
        return SubCategoryRouteHandler::new();
    }
}
