<?php

namespace App\Domain\Lenta\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class LentaBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "text";
    }
}
