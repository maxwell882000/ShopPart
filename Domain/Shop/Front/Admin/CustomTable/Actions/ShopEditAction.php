<?php

namespace App\Domain\Shop\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Shop\Front\Admin\Path\ShopRouteHandler;

class ShopEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ShopRouteHandler::new();
    }
}
