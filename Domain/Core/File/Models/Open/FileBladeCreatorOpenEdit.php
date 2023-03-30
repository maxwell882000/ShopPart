<?php

namespace App\Domain\Core\File\Models\Open;

use App\Domain\Core\File\Models\Main\FileBladeCreatorEdit;
use App\Domain\Core\File\Traits\HasRemovedSideBar;

class FileBladeCreatorOpenEdit extends FileBladeCreatorEdit
{
    use HasRemovedSideBar;

    protected function getTemplatePath(): string
    {
        return self::FROM_EDIT_OPEN;
    }

}
