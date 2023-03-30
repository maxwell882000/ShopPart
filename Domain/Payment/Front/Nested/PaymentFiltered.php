<?php

namespace App\Domain\Payment\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableFilterByInterface;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Payment\Front\Main\PaymentIndex;

class PaymentFiltered extends PaymentIndex implements TableFilterByInterface
{
    use TableFilterBy;

    function filterByData(): array
    {
        return [

        ];
    }
}
