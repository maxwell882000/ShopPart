<?php

namespace App\Domain\Policies\Builder;

use App\Domain\Core\Main\Builders\BuilderEntity;

class PolicyBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "policies";
    }
}
