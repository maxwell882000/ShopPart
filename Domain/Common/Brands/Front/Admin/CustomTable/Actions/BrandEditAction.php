<?php

namespace App\Domain\Common\Brands\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Brands\Front\Admin\Path\BrandRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BrandEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return BrandRouteHandler::new();
    }
}
