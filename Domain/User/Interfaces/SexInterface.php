<?php

namespace App\Domain\User\Interfaces;

interface SexInterface
{
    const MAN = 1;
    const WOMEN = 2;
    const MAN_FRONT = "Мужчина";
    const WOMEN_FRONT = "Женщина";
    const DB_TO_FRONT = [
        self::MAN => self::MAN_FRONT,
        self::WOMEN => self::WOMEN_FRONT
    ];
}
