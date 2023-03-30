<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableDecline;

class ProductNestedDeclineTable extends ProductDeclineTable
{
    public function getCommonColumns(): array
    {
        return [
            ...parent::getCommonColumns(),
            Column::new(__("Количество покупки"), "take_number"),
        ];
    }
}
