<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\FiltrationCategory;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class FiltrationCategoryService extends BaseService
{
    public function getEntity(): Entity
    {
        return new FiltrationCategory();
    }
}
