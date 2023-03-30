<?php

namespace App\Domain\Shop\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class WorkTimeBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "day";
    }
}
