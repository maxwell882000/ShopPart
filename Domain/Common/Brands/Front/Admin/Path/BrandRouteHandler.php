<?php

namespace App\Domain\Common\Brands\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class BrandRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::BRAND;
    }
}
