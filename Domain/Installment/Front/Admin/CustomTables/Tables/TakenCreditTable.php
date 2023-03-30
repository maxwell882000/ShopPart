<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireStatusColumn;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler;

class TakenCreditTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return TakenCreditRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            new Column(__("ID заказа"), "id_purchase"),
            new Column(__("Ф.И.О"), "client_index"),
            new Column(__("Номер телефона"), "phone_index"),
            new Column(__("Cумма договора"), "all_sum_index"),
            new Column(__("Сальдо"), "saldo_index"),
            new Column(__("Остаток"), "rest_index"),
            new Column(__("Статус"), "status_index"),
//            new Column(__("Дата подтверждения рассрочки"), "date_approval_index"),
        ];
    }
}
