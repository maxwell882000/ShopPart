<?php

namespace App\Domain\User\Interfaces;

interface UserRelationInterface extends UserNotificationType
{
    const USER_DATA = self::USER_DATA_SERVICE . \CR::CR;
    const CRUCIAL_DATA = self::USER_DATA . self::CRUCIAL_DATA_SERVICE . \CR::CR;
    const AVATAR_DATA = self::AVATAR_SERVICE . \CR::CR;
    const ROLE_TO = self::ROLE_SERVICE . \CR::CR;
    const ROLE_SERVICE = "role";
    const CRUCIAL_DATA_SERVICE = "crucialData";
    const USER_DATA_SERVICE = "userCreditData";
    const AVATAR_SERVICE = "avatar";
}
