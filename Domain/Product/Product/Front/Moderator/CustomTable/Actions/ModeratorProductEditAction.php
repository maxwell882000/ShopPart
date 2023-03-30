<?php

namespace App\Domain\Product\Product\Front\Moderator\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler;

class ModeratorProductEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ModeratorProductRouteHandler::new();
    }
}
