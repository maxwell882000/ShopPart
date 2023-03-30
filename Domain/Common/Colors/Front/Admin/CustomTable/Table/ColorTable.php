<?php

namespace App\Domain\Common\Colors\Front\Admin\CustomTable\Table;

use App\Domain\Common\Colors\Front\Admin\Path\ColorRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class ColorTable extends AbstractCreateTable
{

    public function getRouteHandler(): RouteHandler
    {
        return new ColorRouteHandler();
    }

    public function getColumns(): array
    {
        return [
            new Column(__("Цвет"), "color_index")
        ];
    }
}
