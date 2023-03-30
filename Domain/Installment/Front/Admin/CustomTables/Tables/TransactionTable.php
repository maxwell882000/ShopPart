<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\BaseTable;

class TransactionTable extends BaseTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Оплачено"), "created_at_index"),
            Column::new(__("Тип"), "type_index"),
            Column::new(__("Сумма"), "amount_index")
        ];
    }
}
