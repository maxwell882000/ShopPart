<?php

namespace App\Domain\Core\File\Traits;

trait HasRemovedSideBar
{

    protected function isWithSideBar(): bool
    {
        return false;
    }
}
