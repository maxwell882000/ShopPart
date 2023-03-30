<?php

namespace App\Domain\User\Entities;

use App\Domain\Core\Main\Entities\Entity;

class Role extends Entity
{
    protected $table = 'roles';
    protected $primaryKey = "role";
}
