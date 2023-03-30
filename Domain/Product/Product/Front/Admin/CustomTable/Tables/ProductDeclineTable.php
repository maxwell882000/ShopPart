<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableDecline;
use App\Domain\Product\Product\Front\Admin\CustomTable\Traits\ProductCommonTable;

class ProductDeclineTable extends AbstractNestedTableDecline
{
    use ProductCommonTable;
}
