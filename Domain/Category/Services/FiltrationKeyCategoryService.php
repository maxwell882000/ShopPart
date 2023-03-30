<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\FiltrationKeyCategory;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class FiltrationKeyCategoryService extends BaseService
{

    public function getEntity(): Entity
    {
        return  FiltrationKeyCategory::new();
    }
}
