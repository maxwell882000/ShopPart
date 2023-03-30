<?php

namespace App\Domain\CreditProduct\Front\Admin\Table;

use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableDecline;
use App\Domain\CreditProduct\Front\Admin\Traits\MainCreditCommonColumn;

class MainCreditNestedDeclineTable extends AbstractNestedTableDecline
{
    use MainCreditCommonColumn;
}
