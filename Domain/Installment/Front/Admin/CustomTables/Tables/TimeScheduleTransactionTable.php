<?php

namespace App\Domain\Installment\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\BaseTable;

class TimeScheduleTransactionTable extends BaseTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Время списания"), 'time_index'),
            Column::new(__("Детали"), "detail_index")
        ];
    }

    public function turnOffActions(): string
    {
        return "1";
    }
}
