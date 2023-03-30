<?php

namespace App\Domain\Category\Front\Admin\CustomTable\Tables;

use App\Domain\Category\Front\Admin\CustomTable\Traits\CommonCategoryTable;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractNestedTableAccept;

class CategoryAcceptTable extends AbstractNestedTableAccept
{
    use CommonCategoryTable;
}
