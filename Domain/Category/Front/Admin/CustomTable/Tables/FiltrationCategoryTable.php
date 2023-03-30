<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Dynamic\FiltrationCategoryDynamicWithoutEntity;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;

class FiltrationCategoryTable extends AbstractDynamicTable
{

    public function getInputs(): array
    {
        return $this->generateNewInput(FiltrationCategoryDynamicWithoutEntity::getCustomRules());
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Название"), "key-index"),
            new Column(__("Компонент"), "attribute-index")
        ];
    }
}
