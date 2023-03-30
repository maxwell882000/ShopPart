<?php

namespace App\Domain\User\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\User\Entities\PlasticCard;
use App\Domain\User\Front\Admin\CustomTable\Tables\PlasticDynamicTable;
use App\Domain\User\Services\PlasticCardService;

class PlasticCardDynamic extends PlasticCard implements TableInFront
{
    use \App\Domain\User\Front\Traits\PlasticCardDynamic;

    public static function getBaseService(): string
    {
        return PlasticCardService::class;
    }

    public
    function getTableClass(): string
    {
        return PlasticDynamicTable::class;
    }


    public
    function getPrimaryKey(): string
    {
        return "id";
    }
}
