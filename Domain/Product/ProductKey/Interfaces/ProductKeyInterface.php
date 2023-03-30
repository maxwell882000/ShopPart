<?php

namespace App\Domain\Product\ProductKey\Interfaces;

interface ProductKeyInterface
{
    const FILTRATION = "filtration";
    const PRODUCT = "product";
    const VALUE = "value";
    const VALUE_CHOICE = "value_choice";
    const PRODUCT_TO = self::PRODUCT . \CR::CR;
    const VALUE_TO = self::PRODUCT . \CR::CR . self::VALUE;
    const TYPE_CHOICE = 0;
    const TYPE_LIST = 1;
    const DB_TO_FRONT = [
        self::TYPE_CHOICE => "Элементы выбора",
        self::TYPE_LIST => "Элементы лист"
    ];
}
