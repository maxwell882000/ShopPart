<?php

namespace App\Domain\User\Front\Admin\CustomTable\Action;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\ShowActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\User\Front\Admin\Path\UserRouteHandler;

class UserShowAction extends ShowActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return UserRouteHandler::new();
    }
}
