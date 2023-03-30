<?php

namespace App\Domain\Core\File\Models\Moderators;

use App\Domain\Core\File\Models\Main\FileBladeCreatorCreate;
use App\Domain\Core\File\Traits\HasModeratorSideBar;

class FBCModeratorCreate extends FileBladeCreatorCreate
{
    use HasModeratorSideBar;

}
