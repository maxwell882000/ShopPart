<?php

namespace App\Domain\Common\Discounts\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class DiscountRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::DISCOUNTS;
    }
}
