<?php

namespace App\Domain\Policies\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class PolicyRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::POLICY;
    }
}
