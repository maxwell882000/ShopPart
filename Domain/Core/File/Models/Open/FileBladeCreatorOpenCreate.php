<?php

namespace App\Domain\Core\File\Models\Open;

use App\Domain\Core\File\Models\Main\FileBladeCreatorCreate;
use App\Domain\Core\File\Traits\HasRemovedSideBar;

class FileBladeCreatorOpenCreate extends FileBladeCreatorCreate
{
    use HasRemovedSideBar;

    protected function getTemplatePath(): string
    {
        return self::FROM_CREATE_OPEN;
    }


}
