<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;

trait ProductCommonTable
{
    public function getCommonColumns(): array
    {
        return [
            Column::new(__("Название"), "name_index"),
            Column::new(__("Цена"), "price_index"),
            Column::new(__("Валюта"), "currency_index"),
            Column::new(__("Количество имееться"), "number_index"),
            Column::new(__("Магазин"), "shop_index"),
            Column::new(__("Категория"), "category_index"),
        ];
    }
}
