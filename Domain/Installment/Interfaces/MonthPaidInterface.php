<?php

namespace App\Domain\Installment\Interfaces;

use App\Domain\Core\Api\CardService\Interfaces\Payable;

interface MonthPaidInterface
{
    const JANUARY = "Январь";
    const FEBRUARY = "Февраль";
    const MARCH = "Март";
    const APRIL = "Апрель";
    const MAY = "Май";
    const JUNE = "Июнь";
    const JULE = "Июль";
    const AUGUST = "Август";
    const SEPTEMBER = "Сентябрь";
    const OCTOBER = "Октябрь";
    const NOVEMBER = "Ноябрь";
    const DECEMBER = "Декабрь";
    const DB_TO_FRONT = [
        1 => self::JANUARY,
        2 => self::FEBRUARY,
        3 => self::MARCH,
        4 => self::APRIL,
        5 => self::MAY,
        6 => self::JUNE,
        7 => self::JULE,
        8 => self::AUGUST,
        9 => self::SEPTEMBER,
        10 => self::OCTOBER,
        11 => self::NOVEMBER,
        12 => self::DECEMBER
    ];
}
