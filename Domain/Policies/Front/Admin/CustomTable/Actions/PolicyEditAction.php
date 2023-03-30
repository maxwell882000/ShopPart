<?php

namespace App\Domain\Policies\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Policies\Front\Admin\Path\PolicyRouteHandler;

class PolicyEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return PolicyRouteHandler::new();
    }
}
