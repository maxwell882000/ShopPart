<?php

namespace App\Domain\Order\Front\Admin\CustomTables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\BaseTable;

class PurchaseTable extends BaseTable
{

    public function getColumns(): array
    {
        return [
            ...$this->getIDDelivery(),
            Column::new(__("Название"), "name_index"),
            Column::new(__("Количество куплено"), "number_index"),
            Column::new(__("Магазин"), "shop_index"),
            Column::new(__("Категория"), "category_index"),
        ];
    }

    protected function getIDDelivery()
    {
        return [

        ];
    }

    public function turnOffActions(): string
    {
        return "1";
    }
}
