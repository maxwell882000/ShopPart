<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Actions;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts\EditActionAbstract;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler;

class TakenCreditEditAction extends EditActionAbstract
{

    public function getRouteHandler(): RouteHandler
    {
        return TakenCreditRouteHandler::new();
    }
}
