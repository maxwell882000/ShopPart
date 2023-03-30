<?php

namespace App\Domain\Core\Front\Traits;

use App\Domain\Core\Main\Services\FrontService;

trait ProvideService
{
    static public function getService(): FrontService
    {
        return new FrontService(self::class);
    }
}
