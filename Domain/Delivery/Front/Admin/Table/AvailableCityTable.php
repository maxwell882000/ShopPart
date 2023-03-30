<?php

namespace App\Domain\Delivery\Front\Admin\Table;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicWithSearchTable;
use App\Domain\Delivery\Front\Admin\Dynamic\AvailableCityDynamic;

class AvailableCityTable extends AbstractDynamicWithSearchTable
{

    public function getInputs(): array
    {
        return $this->generateNewInput(AvailableCityDynamic::getCustomRules());
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Название города UZ"), "cityNameUz-index"),
            new Column(__("Название города RU"), "cityNameRu-index")
        ];
    }
}
