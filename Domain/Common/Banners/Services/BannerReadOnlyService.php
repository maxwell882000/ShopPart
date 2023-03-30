<?php

namespace App\Domain\Common\Banners\Services;

use App\Domain\Common\Banners\Entities\BannerReadOnly;
use App\Domain\Core\Main\Entities\Entity;

class BannerReadOnlyService extends BannerService
{
    public function getEntity(): Entity
    {
        return BannerReadOnly::new();
    }
}
