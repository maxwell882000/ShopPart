<?php

namespace App\Domain\Category\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class CategoryInHomeBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return 'color';
    }
}
