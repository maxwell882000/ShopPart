<?php

namespace App\Domain\CreditProduct\Front\Admin\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\CreditProduct\Front\Admin\Path\MainCreditRouteHandler;

class MainCreditEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return MainCreditRouteHandler::new();
    }
}
