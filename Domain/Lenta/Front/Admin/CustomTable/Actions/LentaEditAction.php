<?php

namespace App\Domain\Lenta\Front\Admin\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Lenta\Front\Admin\Path\LentaRouteHandler;

class LentaEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return  LentaRouteHandler::new();
    }
}
