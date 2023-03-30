<?php

namespace App\Domain\Delivery\Excell\Imports;

use App\Domain\Delivery\Entities\AvailableCities;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class AvailableCityImport implements ToModel , WithUpserts
{

    public function model(array $row): ?AvailableCities
    {
        if($row[0] == "cityId"){
            return  null;
        }
        return new AvailableCities(
            [
                "cityId" => $row[0],
                "cityCode" => $row[1],
                "cityName" => [
                    "ru" => $row[2],
                    "uz" => $row[3],
                    "en" => $row[4]
                ],
                "regionName" => [
                    "ru" => $row[5],
                    "uz" => $row[6],
                    "en" => $row[7]
                ]
            ]
        );
    }

    public function uniqueBy()
    {
        return "cityId";
    }
}
