<?php

namespace App\Domain\Common\Discounts\Front\Admin\CustomTables\Tables;

use App\Domain\Common\Discounts\Front\Admin\Path\DiscountRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireColumn;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireStatusColumn;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class DiscountTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return DiscountRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Баннер для Вэб Uz"), "des_image_uz_index"),
            Column::new(__("Баннер для Вэб Ru"), "des_image_ru_index"),
            Column::new(__("Баннер для моб Uz"), "mob_image_uz_index"),
            Column::new(__("Баннер для моб Ru"), "mob_image_ru_index"),
            new LivewireStatusColumn(__("Статус"),
                "status_table",
                "status"),
            Column::new(__("Процент"), "percent_index"),
            Column::new(__("Количество товаров"), "number_product_index")
        ];
    }
}
