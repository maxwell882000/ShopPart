<?php

namespace App\Domain\Settings\Front\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class SettingRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::SETTING;
    }
}
