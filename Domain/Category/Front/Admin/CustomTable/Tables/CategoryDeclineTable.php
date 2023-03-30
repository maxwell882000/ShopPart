<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Admin\CustomTable\Traits\CommonCategoryTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableDecline;

class CategoryDeclineTable extends AbstractNestedTableDecline
{
    use CommonCategoryTable;
}
