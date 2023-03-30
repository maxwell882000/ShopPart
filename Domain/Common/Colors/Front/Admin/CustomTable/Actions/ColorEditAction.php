<?php

namespace App\Domain\Common\Colors\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Colors\Front\Admin\Path\ColorRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class ColorEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ColorRouteHandler::new();
    }
}
