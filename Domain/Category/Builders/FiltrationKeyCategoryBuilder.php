<?php

namespace App\Domain\Category\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class FiltrationKeyCategoryBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "key";
    }
}
