<?php

namespace App\Domain\User\Front\Dynamic;

use App\Domain\User\Entities\PlasticCardSurety;
use App\Domain\User\Front\Admin\CustomTable\Tables\PlasticDynamicTable;
use App\Domain\User\Services\PlasticCardSuretyService;

class SuretyPlasticCardDynamic extends PlasticCardSurety
{
    use \App\Domain\User\Front\Traits\PlasticCardDynamic;


    public static function getBaseService(): string
    {
        return PlasticCardSuretyService::class;
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
