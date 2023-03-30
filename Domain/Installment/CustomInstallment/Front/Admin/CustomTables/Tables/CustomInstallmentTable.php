<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Installment\CustomInstallment\Front\Admin\Path\CustomInstallmentRouteHandler;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\TakenCreditTable;

class CustomInstallmentTable extends TakenCreditTable
{
    public function getRouteHandler(): RouteHandler
    {
        return CustomInstallmentRouteHandler::new();
    }

}
