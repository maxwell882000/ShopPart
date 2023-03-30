<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;

class UserRole extends Entity
{
    public $incrementing = false;
    protected $primaryKey = "role";
    protected $table = 'user_roles';
}
