<?php


namespace App\Domain\Role\Entities;


use App\Domain\Core\Main\Entities\Entity;

class Role extends Entity
{
    protected $table = 'roles';
    public  function role(){
        return $this->belongsToMany(User::class,'roles');
    }
}
