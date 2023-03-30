<?php

namespace App\Domain\Delivery\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class AvailableCityBuilder extends BuilderEntity
{
    public function filterBy($filter)
    {
        $this->orderBy("id");
        return parent::filterBy($filter);
    }

    protected function getSearch(): string
    {
        return "cityName";
    }
}
