<?php

namespace App\Domain\Common\Banners\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Banners\Front\Admin\Path\BannerRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BannerDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return BannerRouteHandler::new();
    }
}
