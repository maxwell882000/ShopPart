<?php

namespace App\Domain\CreditProduct\Front\Admin\Table;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\CreditProduct\Front\Admin\Path\MainCreditRouteHandler;
use App\Domain\CreditProduct\Front\Admin\Traits\MainCreditCommonColumn;

class MainCreditTable extends AbstractCreateTable
{
    use MainCreditCommonColumn;

    public function getRouteHandler(): RouteHandler
    {
        return MainCreditRouteHandler::new();
    }

    public function getColumns(): array
    {
        return $this->getCommonColumns();
    }
}
