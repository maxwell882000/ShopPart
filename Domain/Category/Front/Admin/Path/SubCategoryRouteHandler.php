<?php

namespace App\Domain\Category\Front\Admin\Path;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class SubCategoryRouteHandler extends RouteHandler
{
    protected function getName(): string
    {
        return AdminRoutesInterface::SUB_CATEGORY;
    }
}
