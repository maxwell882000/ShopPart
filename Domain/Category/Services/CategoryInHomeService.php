<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\CategoryInHome;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class CategoryInHomeService extends BaseService
{

    public function getEntity(): Entity
    {
        return CategoryInHome::new();
    }
}
