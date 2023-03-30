<?php

namespace App\Domain\Common\Colors\Services;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class ColorService extends BaseService
{
    public function getEntity(): Entity
    {
        return  new Color();
    }

}
