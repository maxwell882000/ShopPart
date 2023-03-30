<?php

namespace App\Domain\Product\HeaderText\Front\CustomTables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Product\HeaderText\Entities\HeaderKeyValue;
use App\Domain\Product\HeaderText\Front\Dynamic\HeaderKeyValueDynamicWithoutEntity;

class HeaderKeyValueTable extends AbstractDynamicTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Название RU"), "key_ru-index"),
            Column::new(__("Название UZ"), "key_uz-index"),
//            Column::new(__("Название EN"), "key_en-index"),
            Column::new(__("Значение RU"), "value_ru-index"),
            Column::new(__("Значение UZ"), "value_uz-index"),
//            Column::new(__("Значение EN"), "value_en-index"),
        ];
    }

    public function getInputs(): array
    {
        return  $this->generateInput(HeaderKeyValueDynamicWithoutEntity::getCustomRules());
    }
}
