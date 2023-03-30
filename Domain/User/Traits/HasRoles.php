<?php

namespace App\Domain\User\Traits;

use App\Domain\User\Entities\UserRole;
use App\Domain\User\Interfaces\Roles;

trait HasRoles
{
    public function role(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    public function isAdmin()
    {
        return $this->role->role == Roles::ADMIN_MAIN;
    }

    public function isModerator()
    {
        return $this->role->role == Roles::ADMIN_MODERATOR;
    }

    public function isUser()
    {
        return $this->role->role == Roles::USER;
    }

    public function isShop()
    {
        return $this->role->role == Roles::SHOP;
    }
}
