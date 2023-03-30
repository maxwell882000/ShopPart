<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Api\UserAvatarApi;

class UserAvatarApiService extends BaseService
{

    public function getEntity(): Entity
    {
        return new UserAvatarApi();
    }
}
