<?php

namespace App\Domain\Common\Banners\Front\Admin\File;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Common\Banners\Front\Main\BannerCreate;
use App\Domain\Common\Banners\Front\Main\BannerEdit;
use App\Domain\Common\Banners\Front\Main\BannerIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class BannerCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Banner::class;
    }

    public function getIndexEntity(): string
    {
        return BannerIndex::class;
    }

    public function getCreateEntity(): string
    {
        return BannerCreate::class;
    }

    public function getEditEntity(): string
    {
        return BannerEdit::class;
    }
}
