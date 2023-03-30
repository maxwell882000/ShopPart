<?php

namespace App\Domain\User\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class SuretyBuilder extends BuilderEntity
{


    protected function getSearch(): string
    {
        return "phone";
    }

    protected function getParent(): string
    {
        return "user_id";
    }
}
