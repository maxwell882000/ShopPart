<?php

namespace App\Domain\Installment\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableFilterByInterface;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\OpenButton\Interfaces\FilterInterface;
use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\TakenCreditFilterTable;
use App\Domain\Installment\Front\Main\TakenCreditIndex;

class TakenCreditFiltered extends TakenCreditIndex implements TableFilterByInterface
{
    use TableFilterBy;

    public function getTableClass(): string
    {
        return TakenCreditFilterTable::class;
    }

    function filterByData(): array
    {
        return [
            'user_id' => $this->getWithoutScopeAtrVariable("user_id")
        ];
    }

}
