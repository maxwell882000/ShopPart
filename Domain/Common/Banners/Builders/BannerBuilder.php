<?php

namespace App\Domain\Common\Banners\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class BannerBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "link";
    }
}
