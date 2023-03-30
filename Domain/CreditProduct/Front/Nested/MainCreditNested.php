<?php

namespace App\Domain\CreditProduct\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Traits\TableNested;
use App\Domain\Core\Front\Interfaces\FrontEntityInterface;
use App\Domain\CreditProduct\Front\Admin\Table\MainCreditNestedAcceptTable;
use App\Domain\CreditProduct\Front\Admin\Table\MainCreditNestedDeclineTable;
use App\Domain\CreditProduct\Front\Main\MainCreditIndex;

class MainCreditNested extends MainCreditIndex implements FrontEntityInterface
{
    use TableNested;

    public function getTableClass(): string
    {
        return MainCreditNestedAcceptTable::class;
    }

    public function tableDeclineClass(): string
    {
        return MainCreditNestedDeclineTable::class;
    }
}
