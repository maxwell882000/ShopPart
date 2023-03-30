<?php

namespace App\Domain\Category\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class CategoryAllRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::CATEGORY_ALL;
    }
}
