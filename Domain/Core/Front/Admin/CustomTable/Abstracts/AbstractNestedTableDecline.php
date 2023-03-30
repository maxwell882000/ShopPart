<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableNested;

abstract class AbstractNestedTableDecline extends BaseTable implements TableNested
{
    public function getColumns(): array
    {
        return [
            ...$this->getCommonColumns(),
            new Column(__("Действия"), "decline_button")
        ];
    }
}
