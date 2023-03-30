<?php

namespace App\Domain\Core\File\Models\Moderators;

use App\Domain\Core\File\Models\Main\FileBladeCreatorShow;
use App\Domain\Core\File\Traits\HasModeratorSideBar;

class FBCModeratorShow extends FileBladeCreatorShow
{
    use HasModeratorSideBar;
}
