<?php

namespace App\Domain\Shop\Interfaces;

interface DayInterface
{
    const DB_MONDAY = 1;
    const DB_TUESDAY = 2;
    const DB_WEDNESDAY = 3;
    const DB_THURSDAY = 4;
    const DB_FRIDAY = 5;
    const DB_SATURDAY = 6;
    const DB_SUNDAY = 7;
    const DB_SUNDAY_ALSO = 0;
    const TEXT_MONDAY = "Понедельник";
    const TEXT_TUESDAY = "Вторник";
    const TEXT_WEDNESDAY = "Среда";
    const TEXT_THURSDAY = "Четверг";
    const TEXT_FRIDAY = "Пятница";
    const TEXT_SATURDAY = "Суббота";
    const TEXT_SUNDAY = "Воскресенье";

    const SHORT_TEXT_MONDAY = "Пн";
    const SHORT_TEXT_TUESDAY = "Вт";
    const SHORT_TEXT_WEDNESDAY = "Ср";
    const SHORT_TEXT_THURSDAY = "Чт";
    const SHORT_TEXT_FRIDAY = "Пт";
    const SHORT_TEXT_SATURDAY = "Сб";
    const SHORT_TEXT_SUNDAY = "Вс";

    const DB_TO_FRONT_ONLY = [
        self::DB_MONDAY => self::TEXT_MONDAY,
        self::DB_TUESDAY => self::TEXT_TUESDAY,
        self::DB_WEDNESDAY => self::TEXT_WEDNESDAY,
        self::DB_THURSDAY => self::TEXT_THURSDAY,
        self::DB_FRIDAY => self::TEXT_FRIDAY,
        self::DB_SATURDAY => self::TEXT_SATURDAY,
        self::DB_SUNDAY => self::TEXT_SUNDAY,
    ];

    const DB_TO_FRONT_SHORT = [
        self::DB_MONDAY => self::SHORT_TEXT_MONDAY,
        self::DB_TUESDAY => self::SHORT_TEXT_TUESDAY,
        self::DB_WEDNESDAY => self::SHORT_TEXT_WEDNESDAY,
        self::DB_THURSDAY => self::SHORT_TEXT_THURSDAY,
        self::DB_FRIDAY => self::SHORT_TEXT_FRIDAY,
        self::DB_SATURDAY => self::SHORT_TEXT_SATURDAY,
        self::DB_SUNDAY => self::SHORT_TEXT_SUNDAY,
    ];

    const DB_TO_FRONT = [
        self::DB_SUNDAY_ALSO => self::TEXT_SUNDAY,
        ...self::DB_TO_FRONT_ONLY
    ];
}
