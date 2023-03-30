<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireStatusColumn;

trait CommonCategoryTable
{
    public function getCommonColumns(): array
    {
        return [
            new Column(__("Иконка"), "icon_table"),
            new Column(__("Название"), "name_table"),
            new LivewireStatusColumn(__("Статус"),
                'status_table',
                "status"),
            new Column(__("Подкатегории"), "under_category_table"),
        ];
    }
}
