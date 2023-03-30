<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Action\Models;

use App\Domain\Category\Front\Admin\Path\CategoryRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class CategoryEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return new CategoryRouteHandler();
    }
}
