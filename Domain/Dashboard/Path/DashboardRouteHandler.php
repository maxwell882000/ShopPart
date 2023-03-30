<?php

namespace App\Domain\Dashboard\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class DashboardRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::DASHBOARD;
    }
}
