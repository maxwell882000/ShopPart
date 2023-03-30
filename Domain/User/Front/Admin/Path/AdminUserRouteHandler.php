<?php

namespace App\Domain\User\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class AdminUserRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::ADMIN_USER;
    }
}
