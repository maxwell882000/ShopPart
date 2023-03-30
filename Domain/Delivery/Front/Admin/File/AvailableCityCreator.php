<?php

namespace App\Domain\Delivery\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Delivery\Entities\AvailableCities;
use App\Domain\Delivery\Front\Main\AvailableCitiesCRUD;

class AvailableCityCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return AvailableCities::class;
    }

    public function getIndexEntity(): string
    {
        return "";
    }

    public function getCreateEntity(): string
    {
        return AvailableCitiesCRUD::class;
    }

    public function getEditEntity(): string
    {
        return "";
    }
}
