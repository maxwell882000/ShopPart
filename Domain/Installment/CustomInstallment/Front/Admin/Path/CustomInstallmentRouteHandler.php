<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class CustomInstallmentRouteHandler extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::CUSTOM_INSTALLMENT;
    }
}
