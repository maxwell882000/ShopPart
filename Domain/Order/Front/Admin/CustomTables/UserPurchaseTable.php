<?php

namespace App\Domain\Order\Front\Admin\CustomTables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;

class UserPurchaseTable extends AbstractTable
{

    public function getColumns(): array
    {
        return [
            new Column(__("ID заказа"), "id_purchase"),
            new Column(__("Тип покупки"), "type_purchase"),
            new Column(__("Тип оплаты"), "type_payment"),
            new Column(__("Cумма оплаты"), "all_sum_index"),
            new Column(__("Количество товара"), "num_product_index"),
            new Column(__("Ф.И.О"), "client_index"),
            new Column(__("Номер телефона"), "phone_index"),
        ];
    }
}
