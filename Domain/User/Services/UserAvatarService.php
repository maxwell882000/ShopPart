<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\UserAvatar;

class UserAvatarService extends BaseService
{
    protected function validateCreateRules(): array
    {
        return [
            "name" => "required",
        ];
    }

    public function getEntity(): Entity
    {
        return new UserAvatar();
    }
}
