<?php

namespace App\Domain\Core\Main\Traits;

trait HasIntToTime
{
    private function intToTime(int $value): string
    {
        return sprintf("%s:00", $value);
    }
}
