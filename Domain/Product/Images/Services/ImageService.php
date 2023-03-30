<?php

namespace App\Domain\Product\Images\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Images\Entities\Image;

class ImageService extends BaseService
{

    public function getEntity(): Entity
    {
        return  new Image();
    }
}
