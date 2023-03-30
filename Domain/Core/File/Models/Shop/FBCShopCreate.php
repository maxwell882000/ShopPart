<?php

namespace App\Domain\Core\File\Models\Shop;

use App\Domain\Core\File\Models\Main\FileBladeCreatorCreate;
use App\Domain\Core\File\Traits\HasShopSideBar;

class FBCShopCreate extends FileBladeCreatorCreate
{
    use HasShopSideBar;
}
