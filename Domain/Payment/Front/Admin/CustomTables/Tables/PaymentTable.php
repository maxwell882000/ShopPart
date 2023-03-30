<?php

namespace App\Domain\Payment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;

class PaymentTable extends AbstractTable
{

    public function getColumns(): array
    {
        return [
            new Column(__("ID заказа"), "id_purchase"),
            new Column(__("Cумма оплаты"), "all_sum_index"),
            new Column(__("Количество товара"), "num_product_index"),
            new Column(__("Ф.И.О"), "client_index"),
            new Column(__("Номер телефона"), "phone_index"),
        ];
    }
}
