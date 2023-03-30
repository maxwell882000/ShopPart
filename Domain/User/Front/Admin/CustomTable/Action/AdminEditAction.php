<?php

namespace App\Domain\User\Front\Admin\CustomTable\Action;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\User\Front\Admin\Path\AdminUserRouteHandler;

class AdminEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return AdminUserRouteHandler::new();
    }
}
