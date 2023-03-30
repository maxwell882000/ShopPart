<?php

namespace App\Domain\Policies\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Policies\Front\Admin\Path\PolicyRouteHandler;

class PolicyDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return PolicyRouteHandler::new();
    }
}
