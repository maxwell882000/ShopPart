<?php

namespace App\Domain\Shop\Api;

use App\Domain\Core\Main\Traits\HasIntToTime;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Interfaces\DayInterface;

class ShopMap extends Shop implements DayInterface
{

    public function hours(): array
    {
        $formatWorkDays = [];
        $works = $this->shopAddress->workTime()->orderBy("day")->get();
        foreach ($works as $item) {
            $key = "($item->workTimeFrom:00-$item->workTimeTo:00)";
            if (isset($formatWorkDays[$key])) {
                $formatWorkDays[$key][1] = self::DB_TO_FRONT_SHORT[$item->day];
            } else {
                $formatWorkDays[$key][0] = self::DB_TO_FRONT_SHORT[$item->day];
            }
        }
        return $formatWorkDays;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'longitude' => $this->shopAddress->longitude,
            'latitude' => $this->shopAddress->latitude,
            'name' => $this->name,
            'address' => $this->shopAddress->delivery->getFullAddressAttribute(),
            'work_hours' => $this->hours()
        ];
    }
}
