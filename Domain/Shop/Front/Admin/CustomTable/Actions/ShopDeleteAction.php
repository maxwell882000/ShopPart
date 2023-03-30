<?php

namespace App\Domain\Shop\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Shop\Front\Admin\Path\ShopRouteHandler;

class ShopDeleteAction extends DeleteActionAbstract
{
    public function getRouteHandler(): RouteHandler
    {
       return  ShopRouteHandler::new();
    }

}
