<?php

namespace App\Domain\Order\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class UserPurchaseRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::NEW_ORDERS;
    }
}
