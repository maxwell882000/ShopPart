<?php

namespace App\Domain\Core\File\Models\Shop;

use App\Domain\Core\File\Models\Main\FileBladeCreatorCreateNext;
use App\Domain\Core\File\Traits\HasShopSideBar;

class FBCShopCreateNext extends FileBladeCreatorCreateNext
{
    use HasShopSideBar;
}
