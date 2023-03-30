<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\CrucialData;

class CrucialDataService extends BaseService
{
    public function preValidate($crucial_date)
    {
        $this->validating($crucial_date, [
            "firstname" => "required",
            "lastname" => "required",
            "father_name" => "required",
            "series" => "required",
            "date_of_birth" => "required",
            "pnfl" => "required",
        ]);
    }

    public function getEntity(): Entity
    {
        return new CrucialData();
    }
}
