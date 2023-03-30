<?php

namespace App\Domain\Category\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class FiltrationCategoryBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return 'key';
    }
    protected function getParent(): string
    {
        return 'category_id';
    }
}
