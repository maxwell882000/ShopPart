<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\User\Traits\HasUserRelationship;

class PhoneCode extends Entity
{
    use HasUserRelationship;

    public $incrementing = false;
    protected $primaryKey = "user_id";
    protected $table = "phone_code";

}
