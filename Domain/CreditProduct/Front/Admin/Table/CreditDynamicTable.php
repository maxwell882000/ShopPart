<?php

namespace App\Domain\CreditProduct\Front\Admin\Table;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractDynamicTable;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\InputTableAttribute;
use App\Domain\CreditProduct\Entity\Credit;

class CreditDynamicTable extends AbstractDynamicTable
{
    public function getInputs(): array
    {
        return $this->generateInput(Credit::getRules(), "entity.");
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Процент"), "percent-index"),
            new Column(__("Месяц"), "month-index")
        ];
    }
}
