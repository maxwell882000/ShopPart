<?php

namespace App\Domain\Common\Discounts\Front\Admin\CustomTables\Actions;

use App\Domain\Common\Discounts\Front\Admin\Path\DiscountRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class DiscountEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return DiscountRouteHandler::new();
    }
}
