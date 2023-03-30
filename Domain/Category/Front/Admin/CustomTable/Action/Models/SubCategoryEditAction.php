<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Action\Models;

use App\Domain\Category\Front\Admin\Path\SubCategoryRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class SubCategoryEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return SubCategoryRouteHandler::new();
    }
}
