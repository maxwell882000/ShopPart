<?php

namespace App\Domain\Core\File\Models\Moderators;

use App\Domain\Core\File\Models\Main\FileBladeCreatorCreateNext;
use App\Domain\Core\File\Traits\HasModeratorSideBar;

class FBCModeratorCreateNext extends FileBladeCreatorCreateNext
{
    use HasModeratorSideBar;
}
