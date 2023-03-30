<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Admin\Path\ProductRouteHandler;

class ProductEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ProductRouteHandler::new();
    }
}
