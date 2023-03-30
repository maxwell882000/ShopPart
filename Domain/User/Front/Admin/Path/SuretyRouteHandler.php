<?php

namespace App\Domain\User\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class SuretyRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::SURETY;
    }
}
