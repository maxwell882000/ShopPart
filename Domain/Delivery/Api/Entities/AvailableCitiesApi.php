<?php

namespace App\Domain\Delivery\Api\Entities;

use App\Domain\Delivery\Entities\AvailableCities;

class AvailableCitiesApi extends AvailableCities
{
    public function getSearchAttribute()
    {
        return $this->getRegionNameCurrentAttribute() . " " . __("область") . ", " . $this->getCityNameCurrentAttribute();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'search' => $this->getSearchAttribute(),
        ];
    }
}
