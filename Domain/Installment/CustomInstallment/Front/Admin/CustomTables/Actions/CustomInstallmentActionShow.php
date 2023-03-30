<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\ShowActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Installment\CustomInstallment\Front\Admin\Path\CustomInstallmentRouteHandler;

class CustomInstallmentActionShow extends ShowActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return CustomInstallmentRouteHandler::new();
    }
}
