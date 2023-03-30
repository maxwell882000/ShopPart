<?php

namespace App\Domain\Installment\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;

class TakenCreditRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::TAKEN_CREDIT;
    }
}
