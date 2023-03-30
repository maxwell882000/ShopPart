<?php

namespace App\Domain\Core\File\Models\Moderators;

use App\Domain\Core\File\Models\Main\FileBladeCreatorIndex;
use App\Domain\Core\File\Traits\HasModeratorSideBar;

class FBCModeratorIndex extends FileBladeCreatorIndex
{
    use HasModeratorSideBar;

}
