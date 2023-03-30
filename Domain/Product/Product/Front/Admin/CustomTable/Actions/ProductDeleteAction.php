<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Admin\Path\ProductRouteHandler;

class ProductDeleteAction extends DeleteActionAbstract
{
    public function getRouteHandler(): RouteHandler
    {
        return ProductRouteHandler::new();
    }
}
