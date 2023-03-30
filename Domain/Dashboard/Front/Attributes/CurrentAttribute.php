<?php

namespace App\Domain\Dashboard\Front\Attributes;

class CurrentAttribute extends StatisticAttribute
{
    protected function firstKey()
    {
        return "Количество";
    }

    protected function secondKey()
    {
        return "Cумма";
    }
}
