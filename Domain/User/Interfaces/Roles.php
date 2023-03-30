<?php

namespace App\Domain\User\Interfaces;

interface Roles
{
    const USER = 1;
    const SHOP = 2;
    const ADMIN = 30;
    const NOT_ADMIN = 40;
    const MODERATOR = 3;
    const MAIN = 4;


    const ADMIN_MODERATOR = self::ADMIN + self::MODERATOR;
    const ADMIN_MAIN = self::ADMIN + self::MAIN;

    const DB_TO_FRONT = [
        self::ADMIN_MAIN => "Админ",
        self::ADMIN_MODERATOR => "Модератор",
        self::NOT_ADMIN => "Отключить"
    ];
}
