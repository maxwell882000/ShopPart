<?php

namespace App\Domain\Common\Colors\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class ColorRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return  AdminRoutesInterface::COLOR;
    }
}
