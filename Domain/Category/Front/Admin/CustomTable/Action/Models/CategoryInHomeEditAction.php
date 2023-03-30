<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Action\Models;

use App\Domain\Category\Front\Admin\Path\CategoryInHomeRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class CategoryInHomeEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return CategoryInHomeRouteHandler::new();
    }
}
