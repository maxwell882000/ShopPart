<?php

namespace App\Domain\Common\Discounts\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class DiscountBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "";
    }

    public function active()
    {
        return $this->where("status", true);
    }
}
