<?php

namespace App\Domain\Category\Interfaces;

interface FiltrationInterface
{
    const TEXT = 1;
    const IMAGE = 2;
    const DESCRIPTION = 3;
    const TEXT_FRONT = "Текстовый компонент";
    const IMAGE_FRONT = "Картиный компонент";
    const DESCRIPTION_FRONT = "В описании";

    const DB_TO_FRONT = [
        self::TEXT => self::TEXT_FRONT,
        self::IMAGE => self::IMAGE_FRONT,
        self::DESCRIPTION => self::DESCRIPTION_FRONT
    ];
}
