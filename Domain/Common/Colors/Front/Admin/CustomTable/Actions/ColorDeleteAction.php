<?php

namespace App\Domain\Common\Colors\Front\Admin\CustomTable\Actions;

use App\Domain\Common\Colors\Front\Admin\Path\ColorRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class   ColorDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ColorRouteHandler::new();
    }
}
