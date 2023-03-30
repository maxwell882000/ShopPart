<?php

namespace App\Domain\Product\Product\Front\Moderator\CustomTable\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler;

class ModeratorProductDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return ModeratorProductRouteHandler::new();
    }
}
