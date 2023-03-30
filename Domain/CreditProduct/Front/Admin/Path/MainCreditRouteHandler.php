<?php

namespace App\Domain\CreditProduct\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class MainCreditRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::MAIN_CREDIT;
    }
}
