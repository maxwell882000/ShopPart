<?php

namespace App\Domain\Common\Banners\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class BannerRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::BANNER;
    }
}
