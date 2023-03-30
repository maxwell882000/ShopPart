<?php

namespace App\Domain\Core\File\Models\Moderators;

use App\Domain\Core\File\Models\Main\FileBladeCreatorEdit;
use App\Domain\Core\File\Traits\HasModeratorSideBar;

class FBCModeratorEdit extends FileBladeCreatorEdit
{
    use HasModeratorSideBar;

}
