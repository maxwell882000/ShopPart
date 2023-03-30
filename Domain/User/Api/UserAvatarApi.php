<?php

namespace App\Domain\User\Api;

use App\Domain\User\Entities\UserAvatar;

class UserAvatarApi extends UserAvatar
{
    public function toArray()
    {
        return [
            'avatar' => $this->avatar->fullPath()
        ];
    }
}
