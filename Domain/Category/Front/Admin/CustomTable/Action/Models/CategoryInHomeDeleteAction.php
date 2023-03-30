<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Action\Models;

use App\Domain\Category\Front\Admin\Path\CategoryInHomeRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class CategoryInHomeDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return CategoryInHomeRouteHandler::new();
    }
}
