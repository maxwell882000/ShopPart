<?php

namespace App\Domain\Core\Main\Traits;

trait StatusCheck
{
    public function getStatus(int $status, int $mask)
    {
        return !!($status & $mask);
    }

    public function setStatus(string $key, int $mask)
    {
        $this->attributes[$key] = $mask;
    }
}
