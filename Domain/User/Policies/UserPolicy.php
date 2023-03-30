<?php

namespace App\Domain\User\Policies;

use App\Domain\User\Entities\User;

class UserPolicy
{
    public function create(User $user)
    {
        if ($user->userCreditData) {
            return true;
        }
        return false;
    }
}
