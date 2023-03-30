<?php

namespace App\Domain\User\Front\Admin\CustomTable\Action;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\User\Front\Admin\Path\SuretyRouteHandler;

class SuretyDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return SuretyRouteHandler::new();
    }
}
