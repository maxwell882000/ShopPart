<?php

namespace App\Domain\Common\Discounts\Front\Admin\CustomTables\Actions;

use App\Domain\Common\Discounts\Front\Admin\Path\DiscountRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\DeleteActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class DiscountDeleteAction extends DeleteActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return  DiscountRouteHandler::new();
    }
}
