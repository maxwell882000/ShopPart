<?php


namespace App\Domain\Category\Services;


use App\Domain\Category\Entities\IconCat;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class IconCatService extends BaseService
{

    public function getEntity(): Entity
    {
        return new IconCat();
    }

}
