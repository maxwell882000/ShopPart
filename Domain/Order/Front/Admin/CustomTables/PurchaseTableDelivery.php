<?php

namespace App\Domain\Order\Front\Admin\CustomTables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;

class PurchaseTableDelivery extends PurchaseTable
{
    protected function getIDDelivery()
    {
        return [
            Column::new(__("ID доставки"), "id_delivery_index"),
            Column::new(__("Статус доставки"), "status_delivery")
        ];
    }
}
