<?php

namespace App\Domain\CreditProduct\Front\Admin\Table;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableAccept;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\CreditProduct\Front\Admin\Traits\MainCreditCommonColumn;

class MainCreditNestedAcceptTable extends AbstractNestedTableAccept
{
    use MainCreditCommonColumn;
}
