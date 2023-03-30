<?php

namespace App\Domain\Shop\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\Shop\Front\Dynamic\WorkTimesDynamicWithoutEntity;

class WorkTimesDynamicTable extends AbstractDynamicTable
{

    public function getInputs(): array
    {
        return $this->generateNewInput(WorkTimesDynamicWithoutEntity::getCustomRules());
    }

    public function getColumns(): array
    {
        return [
            new Column(__("День"), "day-index"),
            new Column(__("Начало работы в"), "workTimeFrom-index"),
            new Column(__("Конец работы в"), "workTimeTo")
        ];
    }
}
