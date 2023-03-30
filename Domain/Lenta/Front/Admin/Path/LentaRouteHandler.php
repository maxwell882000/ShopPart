<?php

namespace App\Domain\Lenta\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class LentaRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::LENTA;
    }
}
