<?php

namespace App\Domain\Product\Product\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Product\Product\Front\Admin\CustomTable\Traits\ProductCommonTable;
use App\Domain\Product\Product\Front\Admin\Path\ProductRouteHandler;

class ProductTable extends AbstractCreateTable
{
    use ProductCommonTable;

    public function getRouteHandler(): RouteHandler
    {
        return ProductRouteHandler::new();
    }

    public function getColumns(): array
    {
        return $this->getCommonColumns();
    }
}
