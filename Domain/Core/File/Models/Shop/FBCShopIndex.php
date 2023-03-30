<?php

namespace App\Domain\Core\File\Models\Shop;

use App\Domain\Core\File\Models\Main\FileBladeCreatorIndex;
use App\Domain\Core\File\Traits\HasShopSideBar;

class FBCShopIndex extends FileBladeCreatorIndex
{
    use HasShopSideBar;
}
