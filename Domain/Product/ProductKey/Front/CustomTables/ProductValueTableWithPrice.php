<?php

namespace App\Domain\Product\ProductKey\Front\CustomTables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\Product\ProductKey\Front\Dynamic\ProductValueDynamicWithPriceWithoutEntity;

class ProductValueTableWithPrice extends AbstractDynamicTable
{
    public function getInputs(): array
    {
        return $this->generateNewInput(ProductValueDynamicWithPriceWithoutEntity::getCustomRules());
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("Название RU"), "text_ru-index"),
            Column::new(__("Название UZ"), "text_uz-index"),
            Column::new(__("Цена"), "price-index"),
        ];
    }
}
