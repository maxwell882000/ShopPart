<?php

namespace App\Domain\Payment\Front\Admin\CustomTables\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\ShowActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Payment\Front\Admin\Route\PaymentRouteHandler;

class PaymentShowAction extends ShowActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return  PaymentRouteHandler::new();
    }
}
