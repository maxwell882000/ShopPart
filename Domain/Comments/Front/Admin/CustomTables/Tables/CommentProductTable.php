<?php

namespace App\Domain\Comments\Front\Admin\CustomTables\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireColumn;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireStatusColumn;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\BaseTable;

class CommentProductTable extends BaseTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Продукт"), "product_name"),
            Column::new(__("Пользователь"), "user_name"),
            Column::new(__("Комментарий"), "message_index"),
            new LivewireStatusColumn(__("Статус"),
                "status_index",
                "status")
        ];
    }
}
