<?php

namespace App\Domain\Core\Main\Traits;

trait FastInstantiation
{

    static protected function newClass(string $class, ...$args)
    {
        return new $class(...$args);
    }
}
