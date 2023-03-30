<?php

namespace App\Domain\CreditProduct\Front\Admin\Traits;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;

trait MainCreditCommonColumn
{
    public function getCommonColumns(): array
    {
        return [
            Column::new(__("Название"), "name_index"),
            Column::new(__("Изночальная ставка"), "initial_price_index"),
            Column::new(__("Месяцы"), "initial_month_index"),
        ];
    }
}
