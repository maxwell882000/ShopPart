<?php

namespace App\Domain\Common\Banners\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Banners\Front\Admin\Path\BannerRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BannerEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return BannerRouteHandler::new();
    }
}
