<?php

namespace App\Domain\Common\Banners\Front\Admin\CustomTable\Models;

use App\Domain\Common\Banners\Front\Admin\Path\BannerRouteHandler;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\LivewireStatusColumn;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractCreateTable;
use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class BannerTable extends AbstractCreateTable
{

    public function getColumns(): array
    {
        return [
            Column::new(__("Номер"), "id_index"),
            Column::new("UZ " . __("Баннер"), "image_uz_index"),
            Column::new("RU " . __("Баннер"), "image_ru_index"),
//            Column::new("EN " . __("Баннер"), "image_en_index"),
            new LivewireStatusColumn(__("Статус"),
                'status_index',
                "status"),
            Column::new(__("Линк"), "link_index")
        ];
    }

    public function getRouteHandler(): RouteHandler
    {
        return BannerRouteHandler::new();
    }
}
