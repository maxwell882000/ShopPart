<?php

namespace App\Domain\Common\Brands\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Brands\Front\Admin\Path\BrandRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BrandDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return BrandRouteHandler::new();
    }
}
