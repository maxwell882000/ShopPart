<?php

namespace App\Domain\Lenta\Interfaces;

interface SideInterface
{
    const RIGHT = 0;
    const LEFT = 1;
    const RIGHT_FRONT = "Картинка с правой стороны";
    const LEFT_FRONT = "Картинка с левой стороны";
    const DB_TO_FRONT = [
        self::RIGHT => self::RIGHT_FRONT,
        self::LEFT => self::LEFT_FRONT
    ];
}
