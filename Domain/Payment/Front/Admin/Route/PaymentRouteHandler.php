<?php

namespace App\Domain\Payment\Front\Admin\Route;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class PaymentRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::PAYMENT;
    }
}
