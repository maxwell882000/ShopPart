<?php

namespace App\Domain\Product\Product\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class ProductRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::PRODUCT;
    }
}
