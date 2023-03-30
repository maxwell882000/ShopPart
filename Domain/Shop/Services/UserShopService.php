<?php

namespace App\Domain\Shop\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\User;
use App\Domain\User\Interfaces\Roles;
use App\Domain\User\Services\AbstractUserService;
use App\Domain\User\Services\UserRoleService;
use App\Domain\User\Traits\PasswordHandle;

class UserShopService extends AbstractUserService
{
    function getRole(): int
    {
        return Roles::SHOP;
    }
}
