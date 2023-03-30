<?php

namespace App\Domain\Policies\Front\Admin\CustomTable\Tables;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Policies\Front\Admin\Path\PolicyRouteHandler;

class PolicyTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return PolicyRouteHandler::new();
    }

    public function getColumns(): array
    {
        return [
            Column::new(__("ID"), "id_index"),
            Column::new(__("Политика и конфеденциальность UZ"), "policies_index_uz"),
            Column::new(__("Политика и конфеденциальность RU"), "policies_index_ru"),
            Column::new(__("Политика и конфеденциальность EN"), "policies_index_en")
        ];
    }
}
