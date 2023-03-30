<?php

namespace App\Domain\User\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\User\Interfaces\Roles;
use Illuminate\Support\Facades\DB;

class AdminBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "phone";
    }

    public function filterBy($filter)
    {
        $this->join("user_roles", "user_roles.user_id", "=", "users.id")
            ->where(DB::raw(sprintf("FLOOR(user_roles.role / %s)", Roles::ADMIN)), "=", 1);
        return parent::filterBy($filter);
    }
}
