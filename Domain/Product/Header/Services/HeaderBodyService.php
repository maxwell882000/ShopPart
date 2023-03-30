<?php

namespace App\Domain\Product\Header\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Header\Entities\HeaderBody;

class HeaderBodyService extends BaseService
{
    public function getEntity(): Entity
    {
        return new HeaderBody();
    }
}
